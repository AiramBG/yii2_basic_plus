<?php

use yii\db\Migration;

/**
 * This migration allows:
 *  - fill database with example translations
 */
class m999999_999999_internationalization_example extends Migration
{
    protected $localesTableName = 'i18n_locales';
    protected $routesTableName = 'i18n_routes';
    protected $supportedLanguagesTableName = 'i18n_languages';

    public function safeUp()
    {
        $this->insert('{{%'.$this->supportedLanguagesTableName.'}}', ['langcode' => 'en', 'localname' => 'English']);
        $this->insert('{{%'.$this->supportedLanguagesTableName.'}}', ['langcode' => 'es', 'localname' => 'Español']);

        //English translation
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'language', 'translation' => 'Language']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'home', 'translation' => 'Home']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'about', 'translation' => 'About']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'contact', 'translation' => 'Contact']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'login', 'translation' => 'Login']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'logout', 'translation' => 'Logout']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'signup', 'translation' => 'Create account']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'congratulations', 'translation' => 'Congratulations!']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'yii_created_successfully', 'translation' => 'You have successfully created your Yii {version} application']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'yii_guide_button', 'translation' => 'The definitive guide to Yii 2.0']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'example_page', 'translation' => 'This is an example page. You may modify the following file to customize its content:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'contact_form_submited', 'translation' => 'Thank you for contacting us. We will respond to you as soon as possible.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'contact_text', 'translation' => 'If you have business inquiries or other questions, please fill out the following form to contact us.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'message', 'translation' => 'Message']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'subject', 'translation' => 'Subject']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'verify_code', 'translation' => 'Verification Code']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'privacy_policy', 'translation' => 'Privacy policy']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'privacy_term1', 'translation' => 'A <strong>privacy policy</strong> is a written presentation of all the measures that a company or organization applies to guarantee the security and the lawful use of the data of the users or clients that it collects in the context of the commercial relationship.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'privacy_term2', 'translation' => 'The <strong>web privacy policy</strong> also details how this data is collected, stored and used, as well as whether it is sent to third parties and, if so, in what way.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'terms_of_use', 'translation' => 'Terms of use']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'terms_def', 'translation' => 'The <strong>terms and conditions</strong> are a set of legal terms defined by the owner of a web page as an agreement between the owner of the web site and the users; detail the policies and procedures carried out by the website. In many ways, the Terms provide the website owner with the ability to protect themselves from potential legal exposure.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'login_msg', 'translation' => 'Please fill out the following fields to login:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'need_an_account', 'translation' => "I don't have a user account"]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'need_validation_email', 'translation' => 'Send a new validation email']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'forgot_password', 'translation' => 'I forgot my password']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_creation', 'translation' => 'Please fill out the following fields to create an user account:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_creation_success', 'translation' => 'User account created successfully']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_validation_email_sent', 'translation' => 'A verification email has been sent to your email address.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_creation_email_subject', 'translation' => 'Welcome to {appname}']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_creation_email_body', 'translation' => 'For your security, we require all users verify their email addresses. Follow the link below to validate your email:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_creation_email_confirmed', 'translation' => 'Your email has been confirmed!']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_creation_err_email_exists', 'translation' => 'This email address has already been taken.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'welcome_username', 'translation' => 'Welcome {name}']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'name', 'translation' => 'Name']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'email', 'translation' => 'Email']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'password', 'translation' => 'Password']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'password_repeat', 'translation' => 'Password repeat']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'remember_me', 'translation' => 'Remember session']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_activation', 'translation' => 'Account activation']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_activation_fail', 'translation' => 'Sorry, we are unable to verify your account with provided token.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_activation_success', 'translation' => 'Your account has been activated.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'you_can_login_now', 'translation' => 'You can now use your password to access the site.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_recovery', 'translation' => 'Account recovery']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_recovery_msg', 'translation' => 'Please, enter the email address you used to create your user account:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_recovery_sended', 'translation' => 'An email has been sent to your email address with a recovery link.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'account_recovery_fail', 'translation' => "We couldn't find an account associated with that email address."]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'hi_username', 'translation' => 'Hello {name},']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'password_reset_warning_msg', 'translation' => 'You are receiving this email because someone has requested an account recovery link. If it was not you, please ignore this message.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'password_reset_link', 'translation' => 'Follow the link below to reset your password:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'password_reset', 'translation' => 'Password reset']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'password_reset_choose', 'translation' => 'Please, choose your new password:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'password_requirements', 'translation' => 'Remember that the password must have at least {min} characters.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'password_dont_match', 'translation' => "Passwords don't match"]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'password_change_success', 'translation' => 'Password changed successfully']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'password_change_fail', 'translation' => 'It was not possible to change your password. Please try again later or contact us to help you.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'login_fail', 'translation' => 'Incorrect {loginField} or {password}.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'dashboard_example', 'translation' => 'This area is only accessible to registered users.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'unread_notifications', 'translation' => 'unread notifications.']);//for accesibility screen readers
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'settings', 'translation' => 'Settings']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'see_all_messages', 'translation' => 'See all messages']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'rbac_test', 'translation' => 'Testing roles and permissions:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'your_permissions', 'translation' => 'Your permissions']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'your_roles', 'translation' => 'Your roles']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'add_role_example', 'translation' => "Click on the following link to get the 'ExampleRole' role. This role has assigned the 'ExampleAccess' permission."]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'remove_role_example', 'translation' => "You can remove the role 'ExampleRole' by clicking on the following link:"]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'link_restricted', 'translation' => "The following link is only accessible with the 'ExampleAccess' permission. Try to access:"]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'test_access', 'translation' => "Test access"]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'access_denied', 'translation' => 'Access denied']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'access_granted', 'translation' => 'Access granted']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'en', 'key' => 'private_area', 'translation' => 'Go to private area']);

        //Spanish translation
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'language', 'translation' => 'Idioma']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'home', 'translation' => 'Inicio']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'about', 'translation' => 'Quienes somos']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'contact', 'translation' => 'Contacto']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'login', 'translation' => 'Iniciar sesión']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'logout', 'translation' => 'Desconectar']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'signup', 'translation' => 'Crear cuenta']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'congratulations', 'translation' => '¡Felicidades!']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'yii_created_successfully', 'translation' => 'Has creado tu aplicación Yii {version} correctamente']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'yii_guide_button', 'translation' => 'La guía definitiva de Yii 2.0']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'example_page', 'translation' => 'Esta es una página de ejemplo. Puedes modificar el siguiente archivo para personalizar su contenido:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'contact_form_submited', 'translation' => 'Gracias por contactar con nosotros. Le enviaremos una respuesta tan pronto como sea posible.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'contact_text', 'translation' => 'Si tiene consultas comerciales u otras preguntas, complete el siguiente formulario para comunicarse con nosotros.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'message', 'translation' => 'Mensaje']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'subject', 'translation' => 'Asunto']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'verify_code', 'translation' => 'Código de verificación']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'privacy_policy', 'translation' => 'Política de privacidad']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'privacy_def1', 'translation' => 'Una <strong>política de privacidad</strong> es una presentación por escrito de todas las medidas que aplica una empresa u organización para garantizar la seguridad y el uso lícito de los datos de los usuarios o clientes que recoge en el contexto de la relación comercial.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'privacy_def2', 'translation' => 'La <strong>política de privacidad web</strong> también detalla la forma en que se recolectan, se almacenan y se utilizan estos datos, así como si se envían a terceros y, en caso afirmativo, de qué manera.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'terms_of_use', 'translation' => 'Términos de uso']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'terms_def', 'translation' => 'Los <strong>términos y condiciones</strong> son un conjunto de términos legales definidos por el propietario de una página web a modo de acuerdo entre el propietario del sitio web y los usuarios; detallan las políticas y procedimientos realizados por el sitio web. En muchos sentidos, los Términos brindan al propietario de la página web la posibilidad de protegerse de una posible exposición legal.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'login_msg', 'translation' => 'Por favor, completa los siguientes campos para iniciar sesión:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'need_an_account', 'translation' => 'No tengo cuenta de usuario']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'need_validation_email', 'translation' => 'Enviar un nuevo correo de validación']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'forgot_password', 'translation' => 'He olvidado mi contraseña']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_creation', 'translation' => 'Por favor, rellena el formulario para crear una cuenta de usuario:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_creation_success', 'translation' => 'Cuenta de usuario creada con éxito']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_validation_email_sent', 'translation' => 'Se ha enviado un email de verificación a tu dirección de correo electrónico.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_creation_email_subject', 'translation' => 'Te damos la bienvenida a {appname}']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_creation_email_body', 'translation' => 'Por seguridad, necesitamos que todos los usuarios validen su dirección de correo electrónico. Sigue el link que tienes debajo para completar la validación:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_creation_email_confirmed', 'translation' => 'Tu dirección de correo electrónico ha sido correctamente confirmada.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_creation_err_email_exists', 'translation' => 'La dirección de correo electrónico ya está siendo utilizada.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'welcome_username', 'translation' => 'Bienvenid@ {name}']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'name', 'translation' => 'Nombre']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'email', 'translation' => 'Correo electrónico']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'password', 'translation' => 'Contraseña']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'password_repeat', 'translation' => 'Repetir contraseña']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'remember_me', 'translation' => 'Recordar sesión']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_activation', 'translation' => 'Activación de cuenta']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_activation_fail', 'translation' => 'Lo sentimos, no hemos podido verificar tu cuenta con el código de validación provisto.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_activation_success', 'translation' => 'Tu cuenta ha sido activada.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'you_can_login_now', 'translation' => 'Ya puedes utilizar tu contraseña para acceder al sitio.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_recovery', 'translation' => 'Recuperación de cuenta']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_recovery_msg', 'translation' => 'Por favor, escribe la dirección de correo electrónico que utilizaste para crear tu cuenta de usuario:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_recovery_sended', 'translation' => 'Se ha enviado un email a tu dirección de correo electrónico con un enlace de recuperación.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'account_recovery_fail', 'translation' => 'No hemos encontrado ninguna cuenta asociada a esa dirección de correo electrónico.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'hi_username', 'translation' => 'Hola {name},']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'password_reset_warning_msg', 'translation' => 'Estás recibiendo este correo porque alguien ha solicitado un enlace de recuperación de tu cuenta. Si no has sido tú, por favor, ignora este mensaje.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'password_reset_link', 'translation' => 'Sigue el siguiente enlace para reiniciar tu contraseña:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'password_reset', 'translation' => 'Reinicio de contraseña']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'password_reset_choose', 'translation' => 'Por favor, escribe una nueva contraseña:']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'password_requirements', 'translation' => 'Recuerda que la contraseña debe tener al menos {min} caracteres.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'password_dont_match', 'translation' => 'Las contraseñas no coinciden']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'password_change_success', 'translation' => 'Contraseña cambiada correctamente']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'password_change_fail', 'translation' => 'No ha sido posible cambiar tu contraseña. Por favor, inténtalo más tarde o contacta con nosotros si necesitas ayuda.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'login_fail', 'translation' => '{loginField} o {password} incorrectos.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'dashboard_example', 'translation' => 'Esta área solo es accesible para usuarios registrados.']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'unread_notifications', 'translation' => 'notificaciones sin leer.']); //accesibility for screen readers
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'settings', 'translation' => 'Configuración']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'see_all_messages', 'translation' => 'Ver todos los mensajes']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'rbac_test', 'translation' => 'Probando roles y permisos']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'your_permissions', 'translation' => 'Tus permisos']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'your_roles', 'translation' => 'Tus roles']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'add_role_example', 'translation' => "Haz click en el siguiente enlace para obtener el rol 'ExampleRole'. Este rol tiene asignado el permiso 'ExampleAccess'."]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'remove_role_example', 'translation' => "Puedes quitarte el rol 'ExampleRole' haciendo click el siguiente enlace:"]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'link_restricted', 'translation' => "El siguiente enlace solo es accesible con el permiso 'ExampleAccess'. Intenta acceder:"]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'test_access', 'translation' => "Probar acceso"]);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'access_denied', 'translation' => 'Acceso denegado']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'access_granted', 'translation' => 'Acceso concedido']);
        $this->insert('{{%'.$this->localesTableName.'}}', ['langcode' => 'es', 'key' => 'private_area', 'translation' => 'Ir al área privada']);


        //The translation routes starts with slash without language prefix
        //if you are using a route alias, then `key` must be the alias.
        //Example: `/about` is alias from `landing/about` (see `rules` in config/web.php)
        $this->insert('{{%'.$this->routesTableName.'}}', ['langcode' => 'es', 'key' => '/about', 'translation' => '/quienes_somos']);
        $this->insert('{{%'.$this->routesTableName.'}}', ['langcode' => 'es', 'key' => '/contact', 'translation' => '/contacto']);
        $this->insert('{{%'.$this->routesTableName.'}}', ['langcode' => 'es', 'key' => '/privacy', 'translation' => '/privacidad']);
        $this->insert('{{%'.$this->routesTableName.'}}', ['langcode' => 'es', 'key' => '/terms', 'translation' => '/terminos']);
        $this->insert('{{%'.$this->routesTableName.'}}', ['langcode' => 'es', 'key' => '/login', 'translation' => '/conectar']);
        $this->insert('{{%'.$this->routesTableName.'}}', ['langcode' => 'es', 'key' => '/signup', 'translation' => '/crear_cuenta']);
        $this->insert('{{%'.$this->routesTableName.'}}', ['langcode' => 'es', 'key' => '/accounts/activation', 'translation' => '/activar_cuenta']);
        $this->insert('{{%'.$this->routesTableName.'}}', ['langcode' => 'es', 'key' => '/profile', 'translation' => '/perfil']);
    }

    public function safeDown()
    {
        $this->db->createCommand()->checkIntegrity(false)->execute();
        $this->truncateTable('{{%'.$this->localesTableName.'}}');
        $this->truncateTable('{{%'.$this->routesTableName.'}}');
        $this->truncateTable('{{%'.$this->supportedLanguagesTableName.'}}');
        $this->db->createCommand()->checkIntegrity(true)->execute();
        $this->execute("ALTER TABLE ".'{{%'.$this->localesTableName.'}}'." AUTO_INCREMENT = 1");
        $this->execute("ALTER TABLE ".'{{%'.$this->routesTableName.'}}'." AUTO_INCREMENT = 1");
        $this->execute("ALTER TABLE ".'{{%'.$this->supportedLanguagesTableName.'}}'." AUTO_INCREMENT = 1");
    }
}
