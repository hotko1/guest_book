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

/* themes/contrib/bootstrap/templates/input/form-element-label.html.twig */
class __TwigTemplate_ffb29454af0e9e1e96519815e2dfbb26e24cdf82fdc85d4455fa202f965ef620 extends \Twig\Template
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
        $__internal_b8a44bb7188f10fa054f3681425c559c29de95cd0490f5c67a67412aafc0f453->enter($__internal_b8a44bb7188f10fa054f3681425c559c29de95cd0490f5c67a67412aafc0f453_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "themes/contrib/bootstrap/templates/input/form-element-label.html.twig"));

        // line 22
        $context["classes"] = [0 => "control-label", 1 => (((        // line 24
($context["title_display"] ?? null) == "after")) ? ("option") : ("")), 2 => ((((        // line 25
($context["title_display"] ?? null) == "invisible") &&  !(($context["is_checkbox"] ?? null) || ($context["is_radio"] ?? null)))) ? ("sr-only") : ("")), 3 => ((        // line 26
($context["required"] ?? null)) ? ("js-form-required") : ("")), 4 => ((        // line 27
($context["required"] ?? null)) ? ("form-required") : (""))];
        // line 30
        if ((( !twig_test_empty(($context["title"] ?? null)) && (($context["title_display"] ?? null) == "invisible")) && (($context["is_checkbox"] ?? null) || ($context["is_radio"] ?? null)))) {
            // line 35
            $context["attributes"] = twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "setAttribute", [0 => "title", 1 => ($context["title"] ?? null)], "method", false, false, true, 35);
            // line 36
            $context["title"] = null;
        }
        // line 42
        if ((( !twig_test_empty(($context["title"] ?? null)) || ($context["is_checkbox"] ?? null)) || ($context["is_radio"] ?? null))) {
            // line 43
            echo "<label";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 43), 43, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["element"] ?? null), 43, $this->source), "html", null, true);
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 43, $this->source), "html", null, true);
            // line 44
            if (($context["description"] ?? null)) {
                // line 45
                echo "<p class=\"help-block\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null), 45, $this->source), "html", null, true);
                echo "</p>";
            }
            // line 47
            echo "</label>";
        }
        
        $__internal_b8a44bb7188f10fa054f3681425c559c29de95cd0490f5c67a67412aafc0f453->leave($__internal_b8a44bb7188f10fa054f3681425c559c29de95cd0490f5c67a67412aafc0f453_prof);

    }

    public function getTemplateName()
    {
        return "themes/contrib/bootstrap/templates/input/form-element-label.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 47,  65 => 45,  63 => 44,  57 => 43,  55 => 42,  52 => 36,  50 => 35,  48 => 30,  46 => 27,  45 => 26,  44 => 25,  43 => 24,  42 => 22,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/bootstrap/templates/input/form-element-label.html.twig", "/var/www/web/themes/contrib/bootstrap/templates/input/form-element-label.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 22, "if" => 30);
        static $filters = array("escape" => 43);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
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
