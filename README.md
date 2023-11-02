<p align="center">
  <br/>
  <h3 align="center">AtBram Financial</h3>
  <p align="center">A laravel based income and expense tracker</p>
  <br/>
  <br/>
</p>



## About The Project

This project is intended to demonstrate how to create a Laravel application that can track income and expenses.

## Screenshots
![Alt text](/localhost_8000_dashboard.png?raw=true "Dashboard")

## Built With

Only using laravel framework with its features.

## Features

Several laravel feature implementations:
* Database structure, we design simple database structure, it might be not strictly `normal`, but we believe its enough to production requirements.
* Migration, all database structure and record has been covered by migration, simply run migration.
* Validation by using form request, with validation input preparation (in sales and purchase route) and passes validation input manipulation.
* We made controller as simple as possible, with only responsible to interact with database and return resource
* Model relationship, we cover relationships as much and as standard as possible, including many-to-many with pivot (in sale and purchase item models)

## License

Distributed under the MIT License. See [LICENSE](https://github.com/bramaningds/Laravel-Point-of-Sale-REST-Api/blob/main/LICENSE.md) for more information.

## Authors

* **Bramaning DS** - *Backend engineer enthusiast* - [Bramaning DS](https://github.com/bramaningds) - **
