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
| Component    | Version | Website/Documentation                                             |
|--------------|---------|-------------------------------------------------------------------|
| Laravel      | 10+     | [Laravel](https://laravel.com/docs/8.x)                           |
| PHP          | 8.2     | [PHP](https://www.php.net/manual/en/migration74.new-features.php) |
| Composer     | 2.6+    | [Composer](https://getcomposer.org/doc/)                          |
| Laravel/Sail | 1.26+   | [Docker](https://docs.docker.com/)                                |
| NPM          | 10+     | [NPM](https://docs.npmjs.com/)                                    |
| TailwindCSS  | 3.3+    | [TailwindCSS](https://tailwindcss.com/docs)                       |
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
3. Now we can build the containers and start the application by running the following command: `./vendor/bin/sail up`
4. Once the containers are built and running you can access the application at https://localhost:yourportnumber
