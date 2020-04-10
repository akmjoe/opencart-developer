<?php

/* install/step_4.twig */
class __TwigTemplate_c8a6735047cb15982487b73d690c215a2165a2a2d254f03d0307e85709dfb981 extends Twig_Template
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
        echo ($context["header"] ?? null);
        echo "
<div class=\"container\">
  <header>
    <div class=\"row\">
      <div class=\"col-sm-6\">
        <h1 class=\"pull-left\">4
          <small>/4</small>
        </h1>
        <h3>";
        // line 9
        echo ($context["heading_title"] ?? null);
        echo "
          <br>
          <small>";
        // line 11
        echo ($context["text_step_4"] ?? null);
        echo "</small>
        </h3>
      </div>
      <div class=\"col-sm-6\">
        <div id=\"logo\" class=\"pull-right hidden-xs\"><img src=\"view/image/logo.png\" alt=\"OpenCart\" title=\"OpenCart\"/></div>
      </div>
    </div>
  </header>

  <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
        // line 20
        echo ($context["error_warning"] ?? null);
        echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>

  <div class=\"visit\">
    <div class=\"row\">

      <div class=\"col-sm-5 col-sm-offset-1 text-center\">
        <p><i class=\"fa fa-shopping-cart fa-5x\"></i></p>
        <a href=\"../\" class=\"btn btn-secondary\">";
        // line 29
        echo ($context["text_catalog"] ?? null);
        echo "</a>
      </div>

      <div class=\"col-sm-5 text-center\">
        <p><i class=\"fa fa-cog fa-5x white\"></i></p>
        <a href=\"../admin/\" class=\"btn btn-secondary\">";
        // line 34
        echo ($context["text_admin"] ?? null);
        echo "</a>
      </div>

    </div>
  </div>


  <div class=\"core-modules\">";
        // line 41
        echo ($context["promotion"] ?? null);
        echo "</div>

  <div class=\"modules\">
    <div class=\"row\">
      <div class=\"col-sm-12 text-center\"><a href=\"https://www.opencart.com/index.php?route=marketplace/extension&utm_source=opencart_install&utm_medium=store_link&utm_campaign=opencart_install\" target=\"_BLANK\" class=\"btn btn-default\">";
        // line 45
        echo ($context["text_extension"] ?? null);
        echo "</a></div>
    </div>
  </div>

  <div class=\"mailing\">
    <div class=\"row\">
      <div class=\"col-sm-12\"><i class=\"fa fa-envelope-o fa-5x\"></i>
        <h3>";
        // line 52
        echo ($context["text_mail"] ?? null);
        echo "
          <br/>
          <small>";
        // line 54
        echo ($context["text_mail_description"] ?? null);
        echo "</small>
        </h3>
        <a href=\"http://newsletter.opencart.com/h/r/B660EBBE4980C85C\" target=\"_BLANK\" class=\"btn btn-secondary\">";
        // line 56
        echo ($context["button_mail"] ?? null);
        echo "</a></div>
    </div>
  </div>

  <div class=\"support text-center\">

    <div class=\"row\">
      <div class=\"col-sm-4\">
        <a href=\"https://www.facebook.com/opencart/\" class=\"icon transition\"><i class=\"fa fa-facebook fa-4x\"></i></a>
        <h3>";
        // line 65
        echo ($context["text_facebook"] ?? null);
        echo "</h3>
        <p>";
        // line 66
        echo ($context["text_facebook_description"] ?? null);
        echo "</p>
        <a href=\"https://www.facebook.com/opencart/\">";
        // line 67
        echo ($context["text_facebook_visit"] ?? null);
        echo "</a>
      </div>
      <div class=\"col-sm-4\">
        <a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\" class=\"icon transition\"><i class=\"fa fa-comments fa-4x\"></i></a>
        <h3>";
        // line 71
        echo ($context["text_forum"] ?? null);
        echo "</h3>
        <p>";
        // line 72
        echo ($context["text_forum_description"] ?? null);
        echo "</p>
        <a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\">";
        // line 73
        echo ($context["text_forum_visit"] ?? null);
        echo "</a>
      </div>
      <div class=\"col-sm-4\">
        <a href=\"https://www.opencart.com/index.php?route=support/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" class=\"icon transition\"><i class=\"fa fa-user fa-4x\"></i></a>
        <h3>";
        // line 77
        echo ($context["text_commercial"] ?? null);
        echo "</h3>
        <p>";
        // line 78
        echo ($context["text_commercial_description"] ?? null);
        echo "</p>
        <a href=\"https://www.opencart.com/index.php?route=support/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" target=\"_BLANK\">";
        // line 79
        echo ($context["text_commercial_visit"] ?? null);
        echo "</a>
      </div>
    </div>
  </div>
</div>
";
        // line 84
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "install/step_4.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  166 => 84,  158 => 79,  154 => 78,  150 => 77,  143 => 73,  139 => 72,  135 => 71,  128 => 67,  124 => 66,  120 => 65,  108 => 56,  103 => 54,  98 => 52,  88 => 45,  81 => 41,  71 => 34,  63 => 29,  51 => 20,  39 => 11,  34 => 9,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "install/step_4.twig", "");
    }
}
