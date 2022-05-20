<p align="center"><img src="https://www.filepicker.io/api/file/PrjQ7ZxTQye3aR2Tzt3N" width="400"></p>

# Laravel Boolpress Project

In questa repo noi della Classe #56 del corso per Full Stack Web Developers di Boolean Careers abbiamo l'obiettivo di creare un CMS per la gestione di posts con la possibilità di registrarsi come utenti e accedere ad ulteriori funzionalità (creazione/editing/rimozione dei posts).

Il progetto è stato creato utilizzando la [versione 7.0 di Laravel](https://laravel.com/docs/7.x).

Dopo aver clonato la repo in locale e importata in un nuovo progetto all'interno del proprio editor di codice (ad esempio, VSCode) , i passi da eseguire per poterci lavorare sono i seguenti:

1. All'interno del terminale:
    - <code>composer install</code>
    - <code>npm install</code>
    - <code>cp .env.example .env</code>
    - <code>php artisan key:generate</code>
    - <code>npm install bootstrap</code>
    - <code>composer remove fzaninotto/faker</code>
    - <code>composer require fakerphp/faker</code>
    - <code>composer require laravel/ui:^2.4</code>
    - <code>npm run watch</code> (Se non funziona verificare che sia presente la cartella "node_modules"; in caso contrario lanciare nuovamente <code>npm install</code>)
    - <code>php artisan serve</code>
1. Database:
    - su phpMyAdmin creare un nuovo database;
    - nel file .env inserire il nome del database creato alla voce "DB_DATABASE=...";
    - nel file .env aggiornare in base alle proprie impostazioni tutti gli altri campi del database (DB_PORT, DB_USERNAME, DB_PASSWORD)
1. Per creare le tabelle e popolare il database con dati generati casualmente dal faker in base alle impostazioni contenute nel model e nel seeder, digitare i seguenti comandi all'interno del terminale:
    - <code>php artisan migrate --seed</code>



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
