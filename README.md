# Laravel File Uploads with S3

This repo showcases a simple, concrete example of how to upload files to Amazon S3 using Laravel.

Using S3 offers the advantage of offloading file storage to a dedicated service, which can be more cost-effective and scalable than storing files on your own server.

This project utilises [Uppy](https://uppy.io), a JavaScript file uploader that easily integrates into your frontend application.
For handling file uploads on the backend, this project emulates the Uppy Companion server in Laravel.

Credit goes to [TappNetwork](https://github.com/TappNetwork/laravel-uppy-s3-multipart-upload) for providing the original example of this implementation.

## Project Structure

This project is split into two main directories:

1. `/laravel` - The backend laravel application.
2. `/breeze-next` - The frontend Next.js application.

## Getting Started

To get started and running this project locally, please follow the [Getting started guide](.docs/getting-started.md) first.

## Starting the Project

Once you have setup your local environment, you can run the project locally by following these steps:

1. Navigate to the project directory.
2. Run the following command to start both the Laravel backend and Next.js frontend:

```bash
npm run start
```

This command will launch both the Laravel development server and the Next.js development server concurrently.

You can now access the frontend at: http://localhost:3000

## TODO

- [ ] Add unit tests
- [ ] Add docker support
- [ ] Add drivers for different upload types

## Troubleshooting

- If you encounter CORS issues, check your S3 bucket CORS configuration
- Ensure all environment variables are correctly set in both `.env` files
- Check Laravel logs (`storage/logs/laravel.log`) for backend errors

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
