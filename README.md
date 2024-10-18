# Laravel File Uploads with S3

This is a simple concrete example on how you can upload files to Amazon S3 using Laravel.

The advantage to using S3 is that it allows you to offload the storage of files to a dedicated service, which can be more cost-effective and scalable than storing files on your server.

This project uses the [Uppy](https://uppy.io/) which is a JavaScript file uploader that can be easily integrated into your frontend application.
To handle the file uploads on the backend, this project emulates the [Uppy Companion](https://uppy.io/docs/companion/) server in Laravel.

Credits to [TappNetwork](https://github.com/TappNetwork/laravel-uppy-s3-multipart-upload) for an example of how to do this originally.

## Project Structure

This project is split into two main directories:

1. `/laravel` - The backend laravel application.
2. `/breeze-next` - The frontend Next.js application.

## Getting Started

For detailed setup instructions, please refer to the [Getting started guide](.docs/getting-started.md) file.

## Running the Local Development Environment

After following the getting started guide in [Getting started guide](.docs/getting-started.md), you can run the local development environment by following these steps:

1. Navigate to the project directory.
2. Run the following command to start both the Laravel backend and Next.js frontend:
   ```
   npm run start
   ```

This command will launch both the Laravel development server and the Next.js development server concurrently.

You can now access the frontend at: http://localhost:3000

## Troubleshooting

- If you encounter CORS issues, check your S3 bucket CORS configuration
- Ensure all environment variables are correctly set in both `.env` files
- Check Laravel logs (`storage/logs/laravel.log`) for backend errors

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
