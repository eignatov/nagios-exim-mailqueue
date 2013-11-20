#Nagios Exim MailQueue Plugin#

Plugin para enviar a nagios nuestra cola de salida de correo con Exim.

##Test OS##

![alt text](https://cdn2.iconfinder.com/data/icons/fatcow/32x32/centos.png "Centos")

##Installation##

##Server Nagios##

> ES: En el servidor en donde estamos ejecutando nagios debemos primero el comando que se define de la siguiente manera

> ES: Editamos el archivo de Comando de nagios

> EN: On your main Nagios sever, define the service as shown below:

`nano /usr/local/nagios/etc/objects/commands.cfg`

> En: Colocamos nuestro nuevo Servicio

> EN: Define the service:

```
define service{
        use                             generic-service
       	host_name                       Client_01
        service_description             Mail Queue
        check_command                   check_nrpe!check_mailqueue
}
```
> ES: Reiniciamos Nagios para que tome los cambios

> En: Restart nagios: 

`service nagios restart`


Server Client 01 : On your remote client server (nrpe)
--------------------------------------------------------

Configuración del servidor cliente que queremos motinoriar.

> ES: Editamos el archivo de Comando de nagios para el NRPE y agregamos el plugin php

> EN: Edit the nrpe configuration file

`nano /usr/local/nagios/etc/nrpe.cfg`

> ES: Pegamos esta linea al final de todos los comandos

> EN: Add this line at the end of the file

`command[check_mailqueue]=/usr/local/nagios/libexec/check_mailqueue.php`

> ES: Reiniciamos los servicios del NRPE (Esto fue realizado en Centos)

> EN: Restart nrpe daemon (because it depends on xinetd):

`service xinetd restart`


Notes
-----

> En esta configuración del plugin necesitamos configuraciones adicionales para que el sistema operativo nos de permiso de ejecución.


Server Client
---------------

> En el servidor cliente en donde instalamos nuestro plugin necesitamos hacer estas modificaciones en el archivo /etc/sudoers

> On your remote client server (nrpe), you may need to add this lines to
your /etc/sudoers file to avoid permission erros:

> Editamos el archivo

`nano /etc/sudoers`

> ES:Colocamos estas lineas al final del archivo
> La primera linea nos permite darle permiso al usuario nagios para utilizar las TTY
> La segunda linea le damos permiso al usuario nagios para la ejecución de /usr/sbin/exim

> EN: The first line will prevent nagios user from using TTY. And the second
> one grants permissions to the nagios user to execute /usr/sbin/exim
> binary file (used to check the mail queue)

```
Defaults:nagios !requiretty
nagios ALL=NOPASSWD:/usr/sbin/exim
```

Realizado por : By
--------------------------

> Esteban Borgues [NginxTips.com](https://www.nginxtips.com)

> Andrés Rosales [howtophp.net](https://howtophp.net)
