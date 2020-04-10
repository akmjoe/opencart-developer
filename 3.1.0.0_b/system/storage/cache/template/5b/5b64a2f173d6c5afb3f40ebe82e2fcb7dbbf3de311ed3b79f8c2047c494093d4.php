<?php

/* default/template/common/search.twig */
class __TwigTemplate_53f8c31e9c33b2f18719f544c8775eb0c205a763be9735808f669411b83117ca extends Twig_Template
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
        echo "<div id=\"search\" class=\"input-group mb-3\">
  <input type=\"text\" name=\"search\" value=\"";
        // line 2
        echo ($context["search"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["text_search"] ?? null);
        echo "\" class=\"form-control form-control-lg\" aria-label=\"search\">
  <div class=\"input-group-append\">
    <button type=\"button\" class=\"btn btn-light btn-lg\"><i class=\"fas fa-search\"></i></button>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "default/template/common/search.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/template/common/search.twig", "");
    }
}
