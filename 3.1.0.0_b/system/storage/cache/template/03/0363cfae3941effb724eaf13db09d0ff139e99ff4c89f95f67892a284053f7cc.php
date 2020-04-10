<?php

/* default/template/common/currency.twig */
class __TwigTemplate_a66bae070d49ccce077cbdccadd50bbfca40bac8491e87609c38ddbb80b07323 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        if ((twig_length_filter($this->env, ($context["currencies"] ?? null)) > 1)) {
            // line 2
            echo "  <form action=\"";
            echo ($context["action"] ?? null);
            echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-currency\">
    <div class=\"dropdown\">
      <div class=\"dropdown-toggle\" data-toggle=\"dropdown\">
        ";
            // line 5
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
                // line 6
                echo "          ";
                if ((twig_get_attribute($this->env, $this->source, $context["currency"], "symbol_left", []) && (twig_get_attribute($this->env, $this->source, $context["currency"], "code", []) == ($context["code"] ?? null)))) {
                    // line 7
                    echo "            <strong>";
                    echo twig_get_attribute($this->env, $this->source, $context["currency"], "symbol_left", []);
                    echo "</strong>
          ";
                } elseif ((twig_get_attribute($this->env, $this->source,                 // line 8
$context["currency"], "symbol_right", []) && (twig_get_attribute($this->env, $this->source, $context["currency"], "code", []) == ($context["code"] ?? null)))) {
                    // line 9
                    echo "            <strong>";
                    echo twig_get_attribute($this->env, $this->source, $context["currency"], "symbol_right", []);
                    echo "</strong>
          ";
                }
                // line 11
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "        <span class=\"d-none d-md-inline\">";
            echo ($context["text_currency"] ?? null);
            echo "</span> <i class=\"fas fa-caret-down\"></i>
      </div>
      <div class=\"dropdown-menu\">
        ";
            // line 15
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
                // line 16
                echo "          ";
                if (twig_get_attribute($this->env, $this->source, $context["currency"], "symbol_left", [])) {
                    // line 17
                    echo "            <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", []);
                    echo "\" class=\"dropdown-item\">";
                    echo twig_get_attribute($this->env, $this->source, $context["currency"], "symbol_left", []);
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["currency"], "title", []);
                    echo "</a>
          ";
                } else {
                    // line 19
                    echo "            <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", []);
                    echo "\" class=\"dropdown-item\">";
                    echo twig_get_attribute($this->env, $this->source, $context["currency"], "symbol_right", []);
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["currency"], "title", []);
                    echo "</a>
          ";
                }
                // line 21
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "      </div>
    </div>
    <input type=\"hidden\" name=\"code\" value=\"\"/> <input type=\"hidden\" name=\"redirect\" value=\"";
            // line 24
            echo ($context["redirect"] ?? null);
            echo "\"/>
  </form>
";
        }
    }

    public function getTemplateName()
    {
        return "default/template/common/currency.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 24,  98 => 22,  92 => 21,  82 => 19,  72 => 17,  69 => 16,  65 => 15,  58 => 12,  52 => 11,  46 => 9,  44 => 8,  39 => 7,  36 => 6,  32 => 5,  25 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/template/common/currency.twig", "");
    }
}
