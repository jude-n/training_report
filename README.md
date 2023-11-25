``` 
 _____          _       _               _____               _             
|_   _| __ __ _(_)_ __ (_)_ __   __ _  |_   _| __ __ _  ___| | _____ _ __ 
  | || '__/ _` | | '_ \| | '_ \ / _` |   | || '__/ _` |/ __| |/ / _ \ '__|
  | || | | (_| | | | | | | | | | (_| |   | || | | (_| | (__|   <  __/ |   
  |_||_|  \__,_|_|_| |_|_|_| |_|\__, |   |_||_|  \__,_|\___|_|\_\___|_|   
                                |___/                                                                                                       
```
This application is designed to streamline and enhance the way you handle, analyze and summarise your training data. Built with an emphasis on ease of use and efficiency, it's perfect for those who value their time and prefer to get the most essential data extracted from their training files with minimal effort.

---
## Built by
- Jude Norvor
---

## Built with
| Component    | Version |
|--------------|---------|
| Laravel      | 10+     |
| PHP          | 8.2     |
| Composer     | 2.6+    |
| Laravel/Sail | 1.26+   | 
| NPM          | 10+     |
| TailwindCSS  | 3.3+    |
---
### Build instructions
#### Single step build
``` 
./vendor/bin/sail build --no-cache
```

#### Environment Variables
##### Application Variables
|variable| default value                                       | description                 |
|---- |-----------------------------------------------------|-----------------------------|
APP_ENV| local                                               | The application environment |
APP_DEBUG| true                                                | The application debug mode  |
APP_NAME| Training_Report                                                 | The application name        |
APP_PORT| 9000                                                 | The application port        |
APP_URL| http://localhost:9000              | The application url         |
APP_KEY| base64:cnZaer7BC8SY1LjgYpRpFT6ZMECbUGEy34aLeiMiUIc=              | The application key         |
---

## Getting Started
1. Clone the repo to your local machine and cd into the directory
2. See above for the default .env variables you will need to set these in your local .env file and create a .env file if it does not exist.
   1. Or just change the .env.example to .env to have your .env file
4. Now we can build the containers and start the application by running the following command: `./vendor/bin/sail up`
4. Once the containers are built and running you can access the application at https://localhost:yourportnumber
