<?php

declare(strict_types=1);
/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */
function basePath(string $path = '')
{

    //absolute path
    return __DIR__ . '/' . $path;
}


/**
 * Load View located in "views/"
 * 
 * @param string $name
 * @return void
 */
function loadView(string $name, $data = [])
{
    // require basePath("views/{$name}.view.php");
    $viewPath = basePath("views/{$name}.view.php");

    //checar si existe
    if (file_exists($viewPath)) {

        //extrallendo los datos del array
        extract($data);
        require $viewPath; //importalo
        return;
    }
    echo "view '{$name}' not found";
}


/**
 * Load Partials in view/partials
 * 
 * @param string $name
 * @return void
 */
function loadPartial(string $name)
{

    // require basePath("views/partials/{$name}.php");
    $viewPartial = basePath("views/partials/{$name}.php");

    //ve las secciones
    // inspect($viewPartial);

    //checar si existe
    if (file_exists($viewPartial)) {
        require $viewPartial; //importalo
        return;
    }
    echo "view '{$name}' not found";
}


/**
 * Insect a value in html
 * 
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

/**
 * Insect a value in html and die
 * 
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value)
{
    echo "<pre>";
    die(var_dump($value)); //kill script after
    echo "</pre>";
}

/**
 * format salary for view files
 *
 * @param string $salary
 * @return string Formatted Salary
 */
function formatSalary($salary)
{
    return '$' . number_format(floatval($salary));
}
