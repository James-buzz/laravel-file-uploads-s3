# Laravel File Uploads with S3

This repo showcases a simple, concrete example of how to upload files to Amazon S3 using Laravel.

Using S3 offers the advantage of offloading file storage to a dedicated service, which can be more cost-effective and scalable than storing files on your own server.

This project utilises [Uppy](https://uppy.io), a JavaScript file uploader that easily integrates into your frontend application.
For handling file uploads on the backend, this project emulates the Uppy Companion server in Laravel.

Credit goes to [TappNetwork](https://github.com/TappNetwork/laravel-uppy-s3-multipart-upload) for providing the original example of this implementation.

## Project

The project uses React for the frontend and Laravel for the backend.
Laravel Sanctum is used for authentication.

To showcase file uploads in this project, we have created two examples:

1. Photo Album - Upload photos to an album.
2. Playground.

Both are accessible from the main page of application when logged in.

## Getting started

To get started, follow the guides below:

- 🔧 [How Uppy works with S3](./docs/how-it-works.md)
- 🏁 [Setting up Local development](./docs/getting-started.md)

## TODO

- [x] Add drivers for different upload types
- [ ] Add unit tests
- [ ] Add docker support


## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
