<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Initialize Twig
$twigLoader = new Twig_Loader_Filesystem(__DIR__ . '/../lib/templates');
$twig = new Twig_Environment($twigLoader, array());

// Compile templates
compile($twig, '404.twig', '404.html');
compile($twig, 'homepage.twig', 'home.html');
compile($twig, 'about.twig', 'about.html');
compile($twig, 'work.twig', 'work.html', model('jobs'));
compile($twig, 'projects.twig', 'projects.html', model('projects'));
compile($twig, 'contact.twig', 'contact.html');
compile($twig, 'site.twig', 'this.html');

/**
 * Compiles a Twig template and saves the resulting HTML
 *
 * @param Twig_Environment $twig
 * @param string $template
 * @param string $outfile
 * @param array $model
 */
function compile(Twig_Environment $twig, $template, $outfile, array $model = array())
{
    printf('Compiling template %s to file %s ... ', $template, $outfile);
    $outfile = __DIR__ . '/../build/' . $outfile;
    file_put_contents($outfile, $twig->render($template, $model));
    printf('done' . PHP_EOL);
}

/**
 * Loads a JSON model and returns the result as an associative array
 *
 * @param string $name
 * @return array
 */
function model($name)
{
    printf('Loading model %s' . PHP_EOL, $name);
    $file = __DIR__ . '/../lib/models/' . $name . '.json';
    return json_decode(file_get_contents($file), true);
}
