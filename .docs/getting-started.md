# Getting Started

This page will walk you through setting up the Laravel File Uploads with S3 project.

## Prerequisites

Ensure you have the following installed:
- PHP 8.1 or higher
- Composer
- Node.js 16.13 or higher
- An Amazon S3 account and bucket

## S3 Configuration

1. Create an S3 bucket in your AWS account if you haven't already.

2. Apply a CORS policy to the bucket. You can use the example from the Uppy documentation:
   https://uppy.io/docs/aws-s3/#setting-up-your-s3-bucket

   Set the `AllowedOrigin` to `http://localhost:3000` or `*`.

## Laravel (Backend) Setup

1. Navigate to the `/laravel` directory.

2. Copy the `.env.example` file to `.env`:
   ```
   cp .env.example .env
   ```

3. Open the `.env` file and fill in the necessary details, including your database configuration.

4. Install the PHP dependencies:
   ```
   composer install
   ```

5. Generate the application key:
   ```
   php artisan key:generate
   ```

6. Run the database migrations:
   ```
   php artisan migrate
   ```

7. Update the `.env` file with your S3 credentials:
   ```
   AWS_ACCESS_KEY_ID=yours3accesskey
   AWS_SECRET_ACCESS_KEY=yours3secretkey
   AWS_DEFAULT_REGION=yourregion
   AWS_BUCKET=yourbucket

   UPPY_COMPANION_DISK=s3
   UPPY_COMPANION_BUCKET=yourbucket
   ```

## Next.js (Frontend) Setup

1. Navigate to the `/breeze-next` directory.

2. Copy the `.env.example` file to `.env`:
   ```
   cp .env.example .env
   ```

3. Open the `.env` file and update it with your backend URL:
   ```
   NEXT_PUBLIC_BACKEND_URL=http://localhost:8000
   ```

4. Install the Node.js dependencies:
   ```
   npm install
   ```

## Final Steps

After completing both the Laravel and Next.js setup:

1. Navigate back to the root directory of the project.

2. You're now ready to run the application locally. Use the following command in the root directory to start both the Laravel and Next.js applications:
   ```
   npm run dev
   ```

This command will launch both the Laravel development server and the Next.js development server concurrently.

You should now be able to access the frontend application at http://localhost:3000 and start using the file upload functionality.