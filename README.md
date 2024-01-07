## Shortener app

A dummy demo dockerized PHP8.2 (based on Symfony) application.

To install it you'll need to launch command "make build up db-init" and add "shortener.local" as "127.0.0.1" into your hosts.

Swagger http://shortener.local/api/doc

POST http://shortener.local/generate

GET http://shortener.local/redirect/{short_url}
