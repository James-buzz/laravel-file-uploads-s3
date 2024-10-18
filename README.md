# Laravel File Uploads with S3

This repository showcases how to upload files to Amazon S3 using Laravel.

It emulates the functionality of Companion in Uppy, providing a concrete example of how to handle file uploads in a Laravel application.

Credits to [TappNetwork](https://github.com/TappNetwork/laravel-uppy-s3-multipart-upload) for an example of how to do this originally.

## Project Structure

This repository consists of two main parts:

1. `/laravel` - The laravel application.
2. `/breeze-next` - The frontend Next.js application.

## Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js 16.13 or higher
- An Amazon S3 account and bucket

## Getting Started

For detailed setup instructions, please refer to the `docs/getting-started.md` file.

## Running the Local Development Environment

After following the getting started guide in `docs/getting-started.md`:

1. Navigate to the root directory of the project.
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
