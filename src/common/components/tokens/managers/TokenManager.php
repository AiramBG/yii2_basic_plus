<?php /** @noinspection ALL */

namespace app\src\common\components\tokens\managers;

use app\src\common\components\tokens\entities\Token;
use app\src\common\components\tokens\exceptions\UnknownBehaviorException;
use app\src\common\components\tokens\exceptions\UnknownTypeException;
use DateTime;
use yii\db\Expression;

/**
 * TokenManager centralizes the creation of validation codes in one place, using a single logic.
 * Any generated tokens are automatically saved in the tokens table and can be retrieved later.
 * All tokens must be associated to a user id.
 *
 * Examples:
 *   - email validation
 *   - password recovery
 *   - access tokens
 *   - discount coupons
 *   - any other unique link
 */
class TokenManager
{
    const TYPE_EMAIL_VALIDATION = 'email_validation';
    const TYPE_PWD_RESET = 'pwd_reset';
    const TYPE_ACCESS_TOKEN = 'access_token';

    const BEHAVIOR_ADD = 'add';
    const BEHAVIOR_UNIQUE = 'unique';
    const BEHAVIOR_RENEW = 'renew';
    const BEHAVIOR_REPLACE = 'replace';

    const DEF_TOKEN_LENGTH = 32;


    /**
     * Returns the accepted list of behaviors
     * @return string[]
     */
    public static function getBehaviors()
    {
        return [
            self::BEHAVIOR_ADD,
            self::BEHAVIOR_UNIQUE,
            self::BEHAVIOR_RENEW,
            self::BEHAVIOR_REPLACE,
        ];
    }

    /**
     * Returns the accepted list of types
     * @return string[]
     */
    public static function getTypes()
    {
        return [
            self::TYPE_EMAIL_VALIDATION,
            self::TYPE_PWD_RESET,
            self::TYPE_ACCESS_TOKEN,
        ];
    }

    /**
     * This method creates a security token for general purposes and saves a copy in the tokens table.
     * A token can be recovered with redeem method.
     *
     * @param int $userId
     * @param string $type      It allows distinguishing between different types of tokens associated
     *                          with the same userId.
     *                          @see constants TYPE_*
     *
     * @param string $behavior  It determines the behavior when trying to insert a new token
     *                          that matches userId and type with another active token.
     *                          @see constants BEHAVIOR_*
     *                              - ADD: adds a new token no matter how many previously exist.
     *                              - UNIQUE: only one is allowed. The second token creation will return the first token.
     *                              - RENEW: update expiration datetime and remaining uses.
     *                              - REPLACE: update expiration datetime, remaining uses and generate a new code.
     *
     * @param int $duration     Period of seconds from now until token expiration.
     * @param int $maxUses      Number of uses before being eliminated.
     *                          By default 0 (unlimited uses until expiration date)
     * @param int $tokenLength
     *
     * @return Token
     * @throws UnknownBehaviorException
     * @throws UnknownTypeException
     * @throws \yii\db\StaleObjectException|\Throwable
     */
    public function create($userId, $type, $behavior, $duration, $maxUses = 0, $tokenLength = 0)
    {
        if (!$this->validateBehavior($behavior)) {
            throw new UnknownBehaviorException();
        }

        if ($maxUses < 1) $maxUses = null;
        if ($tokenLength < 1) $tokenLength = self::DEF_TOKEN_LENGTH;
        $expiration = new Expression("FROM_UNIXTIME(".(time()+$duration).")");
        $token = $this->getToken(['user_id' => $userId], $type);

        if (is_null($token) || $token->behavior == self::BEHAVIOR_ADD) {
            $token = new Token();
            $token->user_id = $userId;
            $token->type = trim(strtolower($type));
            $token->behavior = trim(strtolower($behavior));
            $token->code = $this->generateCode($tokenLength);
            $token->remaining_uses = $maxUses;
            $token->expiration_at = $expiration;
            $token->save();
        }
        elseif ($token->behavior == self::BEHAVIOR_REPLACE) {
            $token->code = $this->generateCode($tokenLength);
            $token->remaining_uses = $maxUses;
            $token->expiration_at = $expiration;
            $token->save();
        }
        elseif ($token->behavior == self::BEHAVIOR_RENEW) {
            $token->remaining_uses = $maxUses;
            $token->expiration_at = $expiration;
            $token->save();
        }

        return $token;
    }

    /**
     * Redeem a token stored in the database only if the token has not expired or it has reached the usage limit.
     * @param string $code
     * @param string $type @see TokenManager::create
     *
     * @return Token|null
     * @throws UnknownTypeException
     * @throws \yii\db\StaleObjectException|\Throwable
     */

    public function redeem($code, $type)
    {
        $token = $this->getToken(['code' => $code], $type);
        if (!is_null($token) && !is_null($token->remaining_uses)) {
            $token->remaining_uses--;
            if ($token->remaining_uses < 1) {
                $token->delete();
            }
            else {
                $token->save();
            }
        }
        return $token;
    }

    /**
     * Returns a list of tokens associated with a userId.
     *
     * @param int $userId
     * @param string $type
     * @param string $behavior
     *
     * @return Token[]
     * @throws UnknownBehaviorException
     * @throws UnknownTypeException
     */
    public function findAll($userId, $type = '', $behavior = '', $showExpiredTokens = false)
    {
        list($where, $params) = $this->getFindClausule($userId, $type, $behavior, $showExpiredTokens);
        return Token::find()->where($where, $params)->all();
    }

    /**
     * Returns the first token that match in type associated with a userId
     *
     * @param int $userId
     * @param string $type
     * @param string $behavior
     *
     * @return Token
     * @throws UnknownBehaviorException
     * @throws UnknownTypeException
     */
    public function findOne($userId, $type)
    {
        list($where, $params) = $this->getFindClausule($userId, $type, '');
        return Token::find()->where($where, $params)->one();
    }

    /**
     * @param int $userId
     * @param string $type
     * @param string $behavior
     * @param bool $showExpiredTokens
     * @return array [[whereArray], [paramsArray]]
     * @throws UnknownBehaviorException
     * @throws UnknownTypeException
     */
    private function getFindClausule($userId, $type = '', $behavior = '', $showExpiredTokens = false)
    {
        $where = ['user_id' => ':uid'];
        $params = [':uid' => $userId];

        if (!empty($type)) {
            if (!$this->validateType($type)) {
                throw new UnknownTypeException();
            }
            $where['type'] = ':typ';
            $params[':typ'] = $type;
        }

        if (!empty($behavior)) {
            if (!$this->validateBehavior($behavior)) {
                throw new UnknownBehaviorException();
            }
            $where['behavior'] = ':beh';
            $params[':beh'] = $behavior;
        }

        if (!$showExpiredTokens) {
            $where[] = 'expired_at > :now';
            $params[':now'] = new DateTime();
        }

        return [$where, $params];
    }

    /**
     * @param array $keyValue ['key' => value] // key = user_id|code
     * @param string $type
     *
     * @return Token|null
     * @throws UnknownTypeException
     * @throws \yii\db\StaleObjectException|\Throwable
     */
    private function getToken($keyValue, $type)
    {
        if (!$this->validateType($type)) {
            throw new UnknownTypeException();
        }
        $keyValue['type'] = $type;

        $token = Token::findOne($keyValue);
        if ($token && (new DateTime($token->expiration_at)) <= (new DateTime())) {
            $token->delete();
            $token = null;
        }
        return $token;
    }



    /**
     * @param int $tokenLength
     * @param bool $onlyNumbers
     * @return string
     */
    protected function generateCode($tokenLength, $onlyNumbers = false)
    {
        $minimunSecurityRandomLength = 3;
        $tokenLength = max($minimunSecurityRandomLength, $tokenLength);

        //You can use Yii::$app->security->generateRandomString($tokenLength) or the solution provided below.

        $buffer = [];

        //Using the time() function to sure unique codes.
        //It works only if $tokenLength is greater than time() length.
        $unique = array_reverse(str_split((string)time()));
        if ($tokenLength > count($unique)+$minimunSecurityRandomLength) {
            $tokenLength -= count($unique);

            //Randomly substitution of some numbers for similar letters.
            if (!$onlyNumbers) {
                $sub = ['oO', 'iIlL', 'zZ','eEfF','aAvV','sS','gG','tTjJ','bBhH','pPrR'];
                foreach ($unique as $number) {
                    if (mt_rand(0, 1) === 1) {
                        $numberChars = $sub[(int)$number];
                        $number = $numberChars[mt_rand(0, strlen($numberChars)-1)];
                    }
                    $buffer[] = $number;
                }
            }
        }

        //Generating the rest of the code with random characters
        $characters = '0123456789'.($onlyNumbers? '' : 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        for ($i = 0; $i < $tokenLength; $i++) {
            $buffer[] = $characters[mt_rand(0, strlen($characters)-1)];
        }
        return implode('', $buffer);
    }

    /**
     * @param string $type
     * @return bool
     */
    protected function validateType($type)
    {
        return in_array($type, self::getTypes());
    }

    /**
     * @param string $behavior
     */
    protected function validateBehavior($behavior)
    {
        return in_array($behavior, self::getBehaviors());
    }

    /**
     * @param int $userId
     * @param string $type
     * @param string $code
     * @return int Number of deleted tokens
     */
    public function removeToken($userId, $type, $code)
    {
        return Token::deleteAll(['user_id' => $userId, 'type' => $type, 'code' => $code]);
    }

    /**
     * @param int $userId
     * @return int Number of deleted tokens
     */
    public function removeAllAccessTokens($userId)
    {
        return Token::deleteAll(['user_id' => $userId, 'type' => self::TYPE_ACCESS_TOKEN]);
    }

}
