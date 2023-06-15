# Diploma Project 🧑‍🎓

Spendwise is a comprehensive personal finance management app designed to help users take control of their spending habits and achieve financial stability. With Spendwise, users can easily create an account or log in to start tracking their expenses and income.

Key features of Spendwise include:

* Transaction management: Users can effortlessly create, categorize, and track their transactions to maintain an accurate record of their financial activities.

* Transaction history: The app provides a clear and organized view of the user's transaction history, allowing them to monitor their spending patterns and make informed decisions about their budget.

* Spending reports: Spendwise generates insightful reports that identify where users spend most of their money, enabling them to recognize areas for potential savings and optimize their budget accordingly.

* Goal setting: Users can set financial goals within the app, such as saving for a specific item or event, and track their progress towards achieving those objectives.

* Financial literacy: Spendwise offers educational resources on various financial topics to help users enhance their understanding of personal finance and make better financial decisions.

Spendwise is an ideal app for those looking to improve their financial health by gaining insights into their spending habits, setting achievable goals, and learning valuable financial literacy skills.


## Technologies Used

- **Laravel**: A PHP framework used for building the backend of the application.
- **Sanctum**: Laravel's lightweight package to handle authentication and API token issuing.
- **Eloquent ORM**: Laravel's ORM for interacting with the database.
- **PostgreSQL**: An advanced open-source relational database.
- **Postman**: A collaboration platform for API development, used for testing our APIs.
- **Heroku**: A cloud platform where the application is deployed.

## Structure of the Project

- `app/Http/Controllers`: Contains all the controller classes for handling different types of requests. Here you will find controllers for transactions, monthly balances, goals, currencies, and user accounts.

- `app/Models`: Contains the Eloquent models for our application. Each model corresponds to a table in the database and represents the data structure.

- `database/migrations`: Contains the database migration files for creating and modifying the database structure. Each migration file is named with a timestamp and describes the changes to make to the database.

- `routes`: Contains the api.php file which defines all the API routes for our application. Each route is associated with a method on a controller.

- `tests`: Contains the application's test suite. Tests are organized by feature.

- `.env`: This is where all environment variables are stored. This includes database credentials, API keys, and other sensitive information.

- `composer.json`: This file lists the PHP dependencies of the project.

- `Procfile`: Used by Heroku to start the correct process for your application.

