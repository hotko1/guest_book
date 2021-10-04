<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/contrib/bootstrap/templates/input/form-element.html.twig */
class __TwigTemplate_e4610bb0f5097b0e4736693671a10cb0f293ed725d7d509be9c4e5b97f444f07 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_b8a44bb7188f10fa054f3681425c559c29de95cd0490f5c67a67412aafc0f453 = $this->extensions["Drupal\\webprofiler\\Twig\\Extension\\ProfilerExtension"];
        $__internal_b8a44bb7188f10fa054f3681425c559c29de95cd0490f5c67a67412aafc0f453->enter($__internal_b8a44bb7188f10fa054f3681425c559c29de95cd0490f5c67a67412aafc0f453_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "themes/contrib/bootstrap/templates/input/form-element.html.twig"));

        // line 51
        $context["classes"] = [0 => "form-item", 1 => "js-form-item", 2 => ("form-type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 54
($context["type"] ?? null), 54, $this->source))), 3 => ("js-form-type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 55
($context["type"] ?? null), 55, $this->source))), 4 => ("form-item-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 56
($context["name"] ?? null), 56, $this->source))), 5 => ("js-form-item-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 57
($context["name"] ?? null), 57, $this->source))), 6 => ((!twig_in_filter(        // line 58
($context["title_display"] ?? null), [0 => "after", 1 => "before"])) ? ("form-no-label") : ("")), 7 => (((        // line 59
($context["disabled"] ?? null) == "disabled")) ? ("form-disabled") : ("")), 8 => ((        // line 60
($context["is_form_group"] ?? null)) ? ("form-group") : ("")), 9 => ((        // line 61
($context["is_radio"] ?? null)) ? ("radio") : ("")), 10 => ((        // line 62
($context["is_checkbox"] ?? null)) ? ("checkbox") : ("")), 11 => ((        // line 63
($context["is_autocomplete"] ?? null)) ? ("form-autocomplete") : ("")), 12 => ((        // line 64
($context["has_error"] ?? null)) ? ("error has-error") : (""))];
        // line 67
        $context["description_classes"] = [0 => "description", 1 => "help-block", 2 => (((        // line 70
($context["description_display"] ?? null) == "invisible")) ? ("visually-hidden") : (""))];
        // line 73
        echo "<div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 73), 73, $this->source), "html", null, true);
        echo ">
  ";
        // line 74
        if (twig_in_filter(($context["label_display"] ?? null), [0 => "before", 1 => "invisible"])) {
            // line 75
            echo "    ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 75, $this->source), "html", null, true);
            echo "
  ";
        }
        // line 77
        echo "
  ";
        // line 78
        if (((($context["description_display"] ?? null) == "before") && twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 78))) {
            // line 79
            echo "    <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 79), "addClass", [0 => ($context["description_classes"] ?? null)], "method", false, false, true, 79), 79, $this->source), "html", null, true);
            echo ">
      ";
            // line 80
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 80), 80, $this->source), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 83
        echo "
  ";
        // line 84
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null), 84, $this->source), "html", null, true);
        echo "

  ";
        // line 86
        if ((($context["label_display"] ?? null) == "after")) {
            // line 87
            echo "    ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 87, $this->source), "html", null, true);
            echo "
  ";
        }
        // line 89
        echo "
  ";
        // line 90
        if (($context["errors"] ?? null)) {
            // line 91
            echo "    <div class=\"form-item--error-message alert alert-danger alert-sm\">
      ";
            // line 92
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null), 92, $this->source), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 95
        echo "
  ";
        // line 96
        if ((twig_in_filter(($context["description_display"] ?? null), [0 => "after", 1 => "invisible"]) && twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 96))) {
            // line 97
            echo "    <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 97), "addClass", [0 => ($context["description_classes"] ?? null)], "method", false, false, true, 97), 97, $this->source), "html", null, true);
            echo ">
      ";
            // line 98
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 98), 98, $this->source), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 101
        echo "</div>
";
        
        $__internal_b8a44bb7188f10fa054f3681425c559c29de95cd0490f5c67a67412aafc0f453->leave($__internal_b8a44bb7188f10fa054f3681425c559c29de95cd0490f5c67a67412aafc0f453_prof);

    }

    public function getTemplateName()
    {
        return "themes/contrib/bootstrap/templates/input/form-element.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 101,  127 => 98,  122 => 97,  120 => 96,  117 => 95,  111 => 92,  108 => 91,  106 => 90,  103 => 89,  97 => 87,  95 => 86,  90 => 84,  87 => 83,  81 => 80,  76 => 79,  74 => 78,  71 => 77,  65 => 75,  63 => 74,  58 => 73,  56 => 70,  55 => 67,  53 => 64,  52 => 63,  51 => 62,  50 => 61,  49 => 60,  48 => 59,  47 => 58,  46 => 57,  45 => 56,  44 => 55,  43 => 54,  42 => 51,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/bootstrap/templates/input/form-element.html.twig", "/var/www/web/themes/contrib/bootstrap/templates/input/form-element.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 51, "if" => 74);
        static $filters = array("clean_class" => 54, "escape" => 73);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
