<?php

/* default/template/extension/module/carousel.twig */
class __TwigTemplate_1606484e0947e645d8b1b939852ad43a3386611f7ee12da692cfe8185a46f94a extends Twig_Template
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
        echo "<div class=\"carousel swiper-viewport\">
  <div id=\"carousel";
        // line 2
        echo ($context["module"] ?? null);
        echo "\" class=\"swiper-container\">
    <div class=\"swiper-wrapper\">
      ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["banners"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
            // line 5
            echo "        <div class=\"swiper-slide text-center\">
          ";
            // line 6
            if (twig_get_attribute($this->env, $this->source, $context["banner"], "link", [])) {
                // line 7
                echo "            <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "link", []);
                echo "\"><img src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "image", []);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "title", []);
                echo "\" class=\"img-fluid\"/></a>
          ";
            } else {
                // line 9
                echo "            <img src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "image", []);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["banner"], "title", []);
                echo "\" class=\"img-fluid\" />
          ";
            }
            // line 11
            echo "        </div>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "    </div>
  </div>
  <div class=\"swiper-pagination carousel";
        // line 15
        echo ($context["module"] ?? null);
        echo "\"></div>
  <div class=\"swiper-pager\">
    <div class=\"swiper-button-next\"></div>
    <div class=\"swiper-button-prev\"></div>
  </div>
</div>
<script type=\"text/javascript\"><!--
\$('#carousel";
        // line 22
        echo ($context["module"] ?? null);
        echo "').swiper({
\tmode: 'horizontal',
\tslidesPerView: 5,
\tslidesPerGroup: 5,
\tpagination: '.carousel";
        // line 26
        echo ($context["module"] ?? null);
        echo "',
\tpaginationClickable: true,
\tnextButton: '.carousel .swiper-button-next',
\tprevButton: '.carousel .swiper-button-prev',
\tautoplay: 2500,
\tloop: true
});
--></script>";
    }

    public function getTemplateName()
    {
        return "default/template/extension/module/carousel.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 26,  79 => 22,  69 => 15,  65 => 13,  58 => 11,  50 => 9,  40 => 7,  38 => 6,  35 => 5,  31 => 4,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/template/extension/module/carousel.twig", "");
    }
}
