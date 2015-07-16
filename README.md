# authSuccessHandlerRedirect
Simple symfony2 authentification success handler to redirect user depending on your logic

If you want to redirect your user after login on route based on thiers roles, you can use this handler.


1 - Copy the directory handler to your bundle
2 - Integrate the directive - success_handler: my_bundle.success.login.handler - in the security.yml file, under the firewalls settings
3 - Declare the service in you Resources/services.yml (or xml if you want)

This repo contains the handler, and the yml file as example.

