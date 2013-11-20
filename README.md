#Nagios Exim MailQueue Plugin#

Plugin para enviar a nagios nuestra cola de salida de correo con Exim.

##Server Nagios##

> En el servidor en donde estamos ejecutando nagios debemos primero el comando que se define de la siguiente manera

> Editamos el archivo de Comando de nagios

`nano /usr/local/nagios/etc/objects/commands.cfg`

> Colocamos nuestro nuevo Comando

```
define service{
        use                             generic-service
       	host_name                       Client_01
        service_description             Mail Queue
        check_command                   check_nrpe!check_mailqueue
}
```
> Reiniciamos Nagios para que tome los cambios

`service nagios restart`


Server Client 01
-----------------

Configuración del servidor cliente que queremos motinoriar.


> Editamos el archivo de Comando de nagios para el NRPE y agregamos el plugin php

`nano /usr/local/nagios/etc/nrpe.cfg`

> Pegamos esta linea al final de todos los comandos

`command[check_mailqueue]=/usr/local/nagios/libexec/check_mailqueue.php`

> Reiniciamos los servicios del NRPE (Esto fue realizado en Centos)

`service xinetd restart`


Notes
-----

> En esta configuración del plugin necesitamos configuraciones adicionales para que el sistema operativo nos de permiso de ejecución.


Server Client
---------------

> En el servidor cliente en donde instalamos nuestro plugin necesitamos hacer estas modificaciones en el archivo /etc/sudoers

> Editamos el archivo

`nano /etc/sudoers`

> Colocamos estas lineas al final del archivo
> La primera linea nos permite darle permiso al usuario nagios para utilizar las TTY
> La segunda linea le damos permiso al usuario nagios para la ejecución de /usr/sbin/exim

```
Defaults:nagios !requiretty
nagios ALL=NOPASSWD:/usr/sbin/exim
```

Realizado por 
---------------

> Esteban Borgues [NginxTips.com](https://www.nginxtips.com)

> Andrés Rosales [howtophp.net](https://howtophp.net)
