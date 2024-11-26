# Book Room Space

This guide will walk you through setting up a local development environment for a Laravel 11 application using Docker. It includes everything you need to run the app with a MySQL database and PHP Apache container.

### Prerequisites

Make sure you have the following installed:

- **Docker** (including Docker Compose)
- **PHP** (optional, if you want to run additional commands outside of Docker)

### Clone the Repository

First, clone the repository containing your Laravel application:

```bash
git clone https://github.com/anvictorsantos/book-room-space.git
cd book-room-space
```


## Setting Up the Environment

### Copy the `.env.example` file to `.env`:

If you don't have a `.env` file, copy the `.env.example` file:

```bash
cp .env.example .env
```

### Update the `.env` file:

Ensure that the database settings and other environment variables are correctly set. For the database configuration, make sure they match what is in the `docker-compose.yml`:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=cesae
DB_USERNAME=root
DB_PASSWORD=root
```

## Building the Docker Containers

### Start Docker Compose:

To build and start the containers, run:

```bash
docker-compose up --build
```

This will build the containers based on the `docker-compose.yml` file and start them. The process may take a few minutes to download and set up the required images.

### Check if everything is running:

Once the containers are up, you should see something like this in your terminal:

```bash
Starting book-room-space-db    ... done
Starting book-room-space-web   ... done
```

Your Laravel app should now be running. You can access it by going to `http://localhost:8000` in your browser.

## Accessing MySQL Database

- **Host**: `localhost`
- **Port**: `3306`
- **Username**: `root`
- **Password**: `root`
- **Database**: `cesae` (as defined in the `.env` file)

## Running Laravel Commands Inside Docker

You can run Laravel artisan commands and other PHP commands inside the `web` container. Here’s how:

### Access the container:

To run commands like `php artisan`, you need to execute them inside the container:

```bash
docker-compose exec web bash
```

This will give you a shell inside the `web` container.

### Run Laravel commands:

Now you can run Laravel commands, for example:

```bash
php artisan migrate
php artisan key:generate
php artisan serve
```

If you need to install dependencies, you can also run `composer install` inside the container.

## Storing Persistent Data

The MySQL database is configured to store data persistently using a named volume `dbdata`. The volume is automatically mounted to `/var/lib/mysql` inside the MySQL container, ensuring that data is retained even if the container is stopped or removed.

You can manage volumes with:

```bash
docker volume ls
docker volume rm dbdata
```

## Stopping the Docker Containers

When you are done working on your project, you can stop the containers by running:

```bash
docker-compose down
```

This will stop and remove the containers. Your data will be preserved in the named volume.

## Troubleshooting

### Logs:

To view logs for any container, use the following command:

```bash
docker-compose logs -f
```

This will show the logs for all containers.

### Accessing the web container:

If you are unable to access the Laravel app or need to debug the web container, you can access the web container's shell by running:

```bash
docker-compose exec web bash
```

### Permissions:

If you encounter any file permission issues, you can adjust the file permissions using the following commands:

```bash
sudo chown -R 1000:1000 ./
```

This ensures that the files are owned by the user ID of the web container.

## Important Notes

- Make sure your `.env` settings for the database (`DB_HOST`, `DB_USERNAME`, etc.) match those configured in the `docker-compose.yml` file.
- If you're using Windows and Docker Desktop, ensure that file sharing is enabled for the directory containing your Laravel project.
- You can add additional services (e.g., Redis, Queue Workers) to the `docker-compose.yml` file if needed.
