## ChatRoom Project
The ChatRoom project is a real-time messaging platform where users can create rooms and chat with others. This application is built using Laravel 10, TailwindCSS for styling, and Pusher for enabling real-time web socket connections.

## Features
- **Real-Time Chat**: Engage in conversations with real-time messaging.
- **Create Rooms**: Users can create their own chat rooms for specific topics.
- **Join Rooms**: Ability to join existing rooms and participate in discussions.
- **User Authentication**: Secure sign in and sign up functionalities to manage user access.
- **Responsive Design**: Utilizes TailwindCSS for a mobile-friendly, responsive design.
## Installation
Ensure you have Composer, Node.js, and npm installed on your system before you proceed.

Clone the repository:
git clone https://github.com/ntd1753/chatroom.git
cd ChatRoom
Install PHP dependencies:
composer install
Install JavaScript dependencies and compile assets:
npm install
npm run build
Copy the .env.example file to .env and configure your environment variables, including your Pusher app credentials:
cp .env.example .env
Generate an application key:
php artisan key:generate
Run migrations:
php artisan migrate
Start the Laravel development server:
php artisan serve
## Technologies Used
- **Laravel 10**: For backend logic and MVC architecture.
- **TailwindCSS**: For utility-first CSS framework for rapid UI development.
- **Pusher**: For enabling real-time, bi-directional communication between web clients and servers.
- **MySQL**: As the database management system.
## Contribution
Feel free to fork the project and submit pull requests. If you find any issues or have suggestions, please open an issue in the repository.

## Contact
For any inquiries, please send an email to ntd1753@.com.
