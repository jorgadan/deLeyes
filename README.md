Prueba DeLeyes
========================

Prueba de ingreso realizada en Symfony3.4

Instalación
--------------

Pasos para ejecutar correctamete la Aplicación web:

  * git clone https://github.com/jorgadan/deleyes.git

  * cd deleyes

  * composer install

  * sudo chmod -R 777 var/logs var/cache var/sessions 

  * php bin/console cache:clear
  
  * sudo chmod -R 777 var/logs var/cache var/sessions 
  
  * php bin/console doctrine:database:create 
  
  * php bin/console doctrine:schema:update --force 
  
  * php bin/console deleyes:start
  
  Usuario Administrador: Admin
  
  Pass: Admin123

El registro de usuario, envía a cambiar la contraseña después de confirmar el correo electrónico
ya que me parece más segura la generación de contraseña de FOS que enviar una contraseña en texto
plano por correo.