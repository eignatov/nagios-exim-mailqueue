Server Nagios
--------------
1.
/usr/local/nagios/etc/objects/commands.cfg


2.
define service{
        use                             generic-service
       	host_name                       Client_01
        service_description             Mail Queue
        check_command                   check_nrpe!check_mailqueue
}

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
