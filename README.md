# About

Demo project that integrates a raw Laravel application with the Evolution API, an open-source and self-hosted whatsApp api, to demonstrate how to send WhatsApp notifications from Laravel.

## 1. Setting up Laravel and Evolution Api

The repository contains two folders: one with the Laravel application and another with the Evolution API. Both applications use Docker and share the same Docker network so they can communicate with each other. 

The evolution-api folder contains only a .env file and a docker-compose file, which is responsible for creating the API container.

Before running the applications, make sure to configure the .env files for both projects. For the Laravel application, you must set the RECIPIENT_WHATSAPP_NUMBER variable, which is the phone number that will receive the message.
The variables WHATSAPP_API_INSTANCE and WHATSAPP_API_KEY will be updated later, after we create an instance in the Evolution API.

WHATSAPP_API_URL=http://evolution_api:8080
WHATSAPP_API_INSTANCE="instance name" 
WHATSAPP_API_KEY="authentication api key"
RECIPIENT_WHATSAPP_NUMBER="recipient whatsapp number"

For the Evolution API, define the AUTHENTICATION_API_KEY key, which works as an arbitrary password. You can keep the default value or set any other one you prefer.

AUTHENTICATION_API_KEY=test

## 2. Running Evolution API

Only after configuring these settings should you run the Evolution container. First, go to the Evolution API folder and run docker compose up -d. This will start the application container.

<img width="1580" height="848" alt="image" src="https://github.com/user-attachments/assets/5003e3d4-3f68-4784-b683-c6e286ed68e7" />

If it starts successfully, access localhost:8080 to make sure it is running. If everything is working, you can then access localhost:8080/manager, the route that provides a web interface for managing Evolution API instances.

<img width="1918" height="875" alt="image" src="https://github.com/user-attachments/assets/11962093-4b34-47a6-a50d-4158e54a37f2" />

With your API key authentication in hand, you can access the interface as an administrator. There, you will create a new instance by clicking Create Instance, choose a name (for example, evo1), and leave the remaining fields with their default values.

<img width="1914" height="948" alt="image" src="https://github.com/user-attachments/assets/8df0ad12-61b2-459a-ad94-9067b46ea496" />
<img width="1917" height="949" alt="image" src="https://github.com/user-attachments/assets/22923270-eb4a-4ea8-b387-68c0e6c9d1a8" />

That’s it — your instance has been created. Now access the instance and click Generate QR Code. A modal will open displaying a QR code. Take the mobile device that will be used to send WhatsApp messages, open WhatsApp on it, go to Linked Devices, and link the device by scanning the QR code.

<img width="1919" height="969" alt="image" src="https://github.com/user-attachments/assets/37e591d3-1a41-4c64-baf4-ff29af0342d1" />

If everything works correctly, that WhatsApp account will now be linked to the Evolution instance.

## 3. Running Laravel

Now you need to fill in the environment variables that were left for later in the Laravel application. 

In the first one, set the name of the instance you created (for example, evo1, if you followed my suggestion). In the second one, set your authentication API key, yes, the same one you defined in the Evolution API .env file and used to access its administration interface.

<img width="1071" height="610" alt="image" src="https://github.com/user-attachments/assets/f8ad34d0-e6d0-44e9-b9a5-d4764757705c" />

Everything is ready. Now, navigate to the Laravel application folder and run docker compose up -d. After that, you need to access the Laravel application container and run the migrations and the seeder. The seeder will create the recipient user, whose phone number will be the one you configured previously.

<img width="1574" height="834" alt="image" src="https://github.com/user-attachments/assets/28b6e7af-3d5a-4f21-8f7f-e05209069d38" />

Now, if you access the Laravel application route /message in your browser, the phone number configured as the recipient will receive a WhatsApp message sent from the WhatsApp account linked to the Evolution instance.

<img width="1918" height="801" alt="image" src="https://github.com/user-attachments/assets/2fa1badb-fec8-425e-a52c-d29aed5c8f91" />
