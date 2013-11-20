Plugin para enviar a nagios nuestra cola de salida de correo con Exim.

#Nagios Exim MailQueue Plugin#

##Server Nagios##

En el servidor en donde estamos ejecutando nagios debemos primero el comando que se define de la siguiente manera

> 1. Editamos el archivo de Comando de nagios

`nano /usr/local/nagios/etc/objects/commands.cfg`

> 2. Colocamos nuestro nuevo Comando

```
define service{
        use                             generic-service
       	host_name                       Client_01
        service_description             Mail Queue
        check_command                   check_nrpe!check_mailqueue
}
```


3.
service nagios restart


Server Client 01
-----------------
1.
`/usr/local/nagios/etc/nrpe.cfg`

2.
`command[check_mailqueue]=/usr/local/nagios/libexec/check_mailqueue.php`

3.
`service xinetd restart`

Notes
-----

Server Client
---------------

1.
`nano /etc/sudoers`

`
Defaults:nagios !requiretty
nagios ALL=NOPASSWD:/usr/sbin/exim
`
