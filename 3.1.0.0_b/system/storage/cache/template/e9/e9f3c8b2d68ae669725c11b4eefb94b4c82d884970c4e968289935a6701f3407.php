<?php

/* default/template/common/footer.twig */
class __TwigTemplate_5fc9ff8716a5907646f525b1501d014a6e1477a274da565e1e7d91d1c77d966f extends Twig_Template
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
        echo "</main>
<footer>
  <div class=\"container\">
    <div class=\"row\">
      ";
        // line 5
        if (($context["informations"] ?? null)) {
            // line 6
            echo "        <div class=\"col-sm-3\">
          <h5>";
            // line 7
            echo ($context["text_information"] ?? null);
            echo "</h5>
          <ul class=\"list-unstyled\">
            ";
            // line 9
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
                // line 10
                echo "              <li><a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "href", []);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["information"], "title", []);
                echo "</a></li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "          </ul>
        </div>
      ";
        }
        // line 15
        echo "      <div class=\"col-sm-3\">
        <h5>";
        // line 16
        echo ($context["text_service"] ?? null);
        echo "</h5>
        <ul class=\"list-unstyled\">
          <li><a href=\"";
        // line 18
        echo ($context["contact"] ?? null);
        echo "\">";
        echo ($context["text_contact"] ?? null);
        echo "</a></li>
          <li><a href=\"";
        // line 19
        echo ($context["return"] ?? null);
        echo "\">";
        echo ($context["text_return"] ?? null);
        echo "</a></li>
          ";
        // line 20
        if (($context["gdpr"] ?? null)) {
            // line 21
            echo "            <li><a href=\"";
            echo ($context["gdpr"] ?? null);
            echo "\">";
            echo ($context["text_gdpr"] ?? null);
            echo "</a></li>
          ";
        }
        // line 23
        echo "          <li><a href=\"";
        echo ($context["sitemap"] ?? null);
        echo "\">";
        echo ($context["text_sitemap"] ?? null);
        echo "</a></li>
        </ul>
      </div>
      <div class=\"col-sm-3\">
        <h5>";
        // line 27
        echo ($context["text_extra"] ?? null);
        echo "</h5>
        <ul class=\"list-unstyled\">
          <li><a href=\"";
        // line 29
        echo ($context["manufacturer"] ?? null);
        echo "\">";
        echo ($context["text_manufacturer"] ?? null);
        echo "</a></li>
          <li><a href=\"";
        // line 30
        echo ($context["voucher"] ?? null);
        echo "\">";
        echo ($context["text_voucher"] ?? null);
        echo "</a></li>
          <li><a href=\"";
        // line 31
        echo ($context["affiliate"] ?? null);
        echo "\">";
        echo ($context["text_affiliate"] ?? null);
        echo "</a></li>
          <li><a href=\"";
        // line 32
        echo ($context["special"] ?? null);
        echo "\">";
        echo ($context["text_special"] ?? null);
        echo "</a></li>
        </ul>
      </div>
      <div class=\"col-sm-3\">
        <h5>";
        // line 36
        echo ($context["text_account"] ?? null);
        echo "</h5>
        <ul class=\"list-unstyled\">
          <li><a href=\"";
        // line 38
        echo ($context["account"] ?? null);
        echo "\">";
        echo ($context["text_account"] ?? null);
        echo "</a></li>
          <li><a href=\"";
        // line 39
        echo ($context["order"] ?? null);
        echo "\">";
        echo ($context["text_order"] ?? null);
        echo "</a></li>
          <li><a href=\"";
        // line 40
        echo ($context["wishlist"] ?? null);
        echo "\">";
        echo ($context["text_wishlist"] ?? null);
        echo "</a></li>
          <li><a href=\"";
        // line 41
        echo ($context["newsletter"] ?? null);
        echo "\">";
        echo ($context["text_newsletter"] ?? null);
        echo "</a></li>
        </ul>
      </div>
    </div>
    <hr>
    <p>";
        // line 46
        echo ($context["powered"] ?? null);
        echo "</p>
    <!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->
  </div>
</footer>
";
        // line 53
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["scripts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 54
            echo "  <script src=\"";
            echo $context["script"];
            echo "\" type=\"text/javascript\"></script>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "</body></html>
";
    }

    public function getTemplateName()
    {
        return "default/template/common/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 56,  178 => 54,  174 => 53,  164 => 46,  154 => 41,  148 => 40,  142 => 39,  136 => 38,  131 => 36,  122 => 32,  116 => 31,  110 => 30,  104 => 29,  99 => 27,  89 => 23,  81 => 21,  79 => 20,  73 => 19,  67 => 18,  62 => 16,  59 => 15,  54 => 12,  43 => 10,  39 => 9,  34 => 7,  31 => 6,  29 => 5,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/template/common/footer.twig", "");
    }
}
