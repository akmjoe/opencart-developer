<?php

/* default/template/common/language.twig */
class __TwigTemplate_6e02cd9451bd89a9c0d5219cfe453ccf2c8c6a84fd706680b61f4474b94edda7 extends Twig_Template
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
        if ((twig_length_filter($this->env, ($context["languages"] ?? null)) > 1)) {
            // line 2
            echo "  <div class=\"dropdown\">
    <div class=\"dropdown-toggle\" data-toggle=\"dropdown\">
      ";
            // line 4
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 5
                echo "        ";
                if ((twig_get_attribute($this->env, $this->source, $context["language"], "code", []) == ($context["code"] ?? null))) {
                    // line 6
                    echo "          <img src=\"catalog/language/";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", []);
                    echo "/";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", []);
                    echo ".png\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", []);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", []);
                    echo "\">
        ";
                }
                // line 8
                echo "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 9
            echo "      <span class=\"d-none d-md-inline\">";
            echo ($context["text_language"] ?? null);
            echo "</span> <i class=\"fas fa-caret-down\"></i>
    </div>
    <div class=\"dropdown-menu\">
      ";
            // line 12
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 13
                echo "        <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "href", []);
                echo "\" class=\"dropdown-item\"><img src=\"catalog/language/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", []);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", []);
                echo ".png\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", []);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", []);
                echo "\"/> ";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", []);
                echo "</a>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            echo "    </div>
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "default/template/common/language.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 15,  65 => 13,  61 => 12,  54 => 9,  48 => 8,  36 => 6,  33 => 5,  29 => 4,  25 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/template/common/language.twig", "");
    }
}
