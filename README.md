# Book Room Space

This guide will walk you through setting up a local development environment for a Laravel 11 application using Docker. It includes everything you need to run the app with a MySQL database and PHP Apache container.

### Prerequisites

Make sure you have the following installed:

- **Docker** (including Docker Compose)
- **PHP** (optional, if you want to run additional commands outside of Docker)

### Clone the Repository

First, clone the repository containing your Laravel application:

```bash
git clone git@github.com:MatheusMasago/gestaoSalasCesae.git
cd gestaoSalasCesae
```

## Setting Up the Environment

### Copy the `.env.example` file to `.env`:

If you don't have a `.env` file, copy the `.env.example` file:

```bash
cp .env.example .env
```

### Update the `.env` file:


### How to start the project and check if its running:

Give permissions to the script 'startproject.sh' like 'chmod +x startproject.sh' and run it like

```bash
chmod +x startproject.sh
./startproject.sh
```

Your Laravel app should now be running. You can access it by going to `http://localhost:8000` in your browser.

## Accessing MySQL Database

- **Host**: `localhost`
- **Port**: `2525`
- **Username**: `root`
- **Password**: `root`
- **Database**: `CESAEBookSpace` (as defined in the `.env` file)

### Run Laravel commands:

Now you can run Laravel commands, for example:

```bash
php artisan migrate
php artisan key:generate
php artisan serve
```

## Troubleshooting

### Permissions:

If you encounter any file permission issues, you can adjust the file permissions using the following commands:

```bash
sudo chown -R 1000:1000 ./
```

This ensures that the files are owned by the user ID of the web container.

## Important Notes

