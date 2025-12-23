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

<img width="1265" height="657" alt="image" src="https://github.com/user-attachments/assets/ea21248e-68e4-41ed-88d1-eafd63ad2440" />

If it starts successfully, access localhost:8080 to make sure it is running. If everything is working, you can then access localhost:8080/manager, the route that provides a web interface for managing Evolution API instances.

<img width="1919" height="817" alt="image" src="https://github.com/user-attachments/assets/a0844b11-d6b7-44cd-97e3-a60bc5696a3f" />

With your API key authentication in hand, you can access the interface as an administrator. There, you will create a new instance by clicking Create Instance, choose a name (for example, evo1), and leave the remaining fields with their default values.

<img width="1919" height="909" alt="image" src="https://github.com/user-attachments/assets/dc8b39ec-d131-4042-84fa-c0543cb1eb5d" />

That’s it — your instance has been created. Now access the instance and click Generate QR Code. A modal will open displaying a QR code. Take the mobile device that will be used to send WhatsApp messages, open WhatsApp on it, go to Linked Devices, and link the device by scanning the QR code.

<img width="1919" height="966" alt="image" src="https://github.com/user-attachments/assets/f8c4abea-08f2-4617-9b31-53b95a29f8ed" />

If everything works correctly, that WhatsApp account will now be linked to the Evolution instance.

## 3. Running Laravel

Now you need to fill in the environment variables that were left for later in the Laravel application. 

In the first one, set the name of the instance you created (for example, evo1, if you followed my suggestion). In the second one, set your authentication API key, yes, the same one you defined in the Evolution API .env file and used to access its administration interface.

<img width="1538" height="592" alt="image" src="https://github.com/user-attachments/assets/147f8bfc-99c7-4a9a-bfaf-813f4153c73a" />

Everything is ready. Now, navigate to the Laravel application folder and run docker compose up -d. After that, you need to access the Laravel application container and run the migrations and the seeder. The seeder will create the recipient user, whose phone number will be the one you configured previously.

<img width="1257" height="656" alt="image" src="https://github.com/user-attachments/assets/21dedf3f-c159-4dd2-b151-cf8fbd1d551f" />

Now, if you access the Laravel application route /message in your browser, the phone number configured as the recipient will receive a WhatsApp message sent from the WhatsApp account linked to the Evolution instance.

<img width="1918" height="815" alt="image" src="https://github.com/user-attachments/assets/12f1645f-957e-4290-b503-005b51aa9236" />
