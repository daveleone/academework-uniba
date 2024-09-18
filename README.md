<p align="center"><a href="" target="_blank"><img src="https://raw.githubusercontent.com/daveleone/academework-uniba/main/public/art/logo.svg" width="400" alt="Laravel Logo"></a></p>

## About Academe Work
Welcome to Academe Works, a dedicated platform designed to empower educators and facilitate seamless interaction between teachers and students. Our mission is to simplify the process of assignment management and enhance the learning experience for both educators and learners.

## Developing

To effectively use this repository, ensure you have the following prerequisites installed:

- **Composer**: Ensure that Composer is installed on your system. If not, install it from [getcomposer.org](https://getcomposer.org/).
- **Node.js**: Ensure Node.js is installed. You can download it from [nodejs.org](https://nodejs.org/).

## Installation Steps

1. After cloning the repository, navigate to the project directory in your terminal.

2. Run the following commands to set up the project dependencies:

   ```bash
   composer install
   npm install
   npm run build
   ```

### Database Setup

For the database functionalities, a MySQL server is required. Ensure you have a MySQL server installed and running on your local machine.

To set up the database schema, execute the following command:

```bash
php artisan migrate
```

This command will create the necessary tables and schema for the application to function correctly.

### Running the Application

Once all dependencies are installed and the database is set up:

```bash
php artisan serve
```

This command will start the server locally, allowing you to access and interact with the application via your web browser at `localhost:8000`.
