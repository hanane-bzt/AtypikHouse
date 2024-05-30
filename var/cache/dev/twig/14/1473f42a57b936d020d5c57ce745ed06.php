<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* admin/habita/index.html.twig */
class __TwigTemplate_bfda308cda514d07e3dbd2ca49ad0993 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 39
        return "admin/admin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/habita/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/habita/index.html.twig"));

        $this->parent = $this->loadTemplate("admin/admin.html.twig", "admin/habita/index.html.twig", 39);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 41
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        // line 0
        yield "Tous les habitats";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        return; yield '';
    }

    // line 43
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 44
        yield " <p> <a class=\"btn btn-primary btn-sm\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("admin.habitat.create");
        yield "\">Ajouter un habitat</a></p>
<div class=\"row\">
    ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["habitats"]) || array_key_exists("habitats", $context) ? $context["habitats"] : (function () { throw new RuntimeError('Variable "habitats" does not exist.', 46, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["habitat"]) {
            // line 47
            yield "    <div class=\"col-md-4 mb-4\">
        <div class=\"card\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["habitat"], "title", [], "any", false, false, false, 50), "html", null, true);
            yield "</h5>
                <p class=\"card-text\">";
            // line 51
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["habitat"], "category", [], "any", false, true, false, 51), "name", [], "any", true, true, false, 51)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["habitat"], "category", [], "any", false, true, false, 51), "name", [], "any", false, false, false, 51), "")) : ("")), "html", null, true);
            yield "</p>
                <div class=\"d-flex justify-content-between align-items-center\">
                    <a href=\"";
            // line 53
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin.habitat.edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["habitat"], "id", [], "any", false, false, false, 53)]), "html", null, true);
            yield "\" class=\"btn btn-primary\">Editer</a>
                    <form action=\"";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin.habitat.delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["habitat"], "id", [], "any", false, false, false, 54)]), "html", null, true);
            yield "\" method=\"post\">
                        <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                        <button type=\"submit\" class=\"btn btn-danger\">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['habitat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        yield "</div>

<div class=\"d-flex justify-content-between\">

  ";
        // line 67
        if (((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 67, $this->source); })()) > 1)) {
            // line 68
            yield "    <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin.habitat.index", ["page" => ((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 68, $this->source); })()) - 1)]), "html", null, true);
            yield "\" class=\"btn btn secondary\">Page précédente</a>
  ";
        }
        // line 70
        yield "
  ";
        // line 71
        if (((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 71, $this->source); })()) < (isset($context["maxPage"]) || array_key_exists("maxPage", $context) ? $context["maxPage"] : (function () { throw new RuntimeError('Variable "maxPage" does not exist.', 71, $this->source); })()))) {
            // line 72
            yield "    <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin.habitat.index", ["page" => ((isset($context["page"]) || array_key_exists("page", $context) ? $context["page"] : (function () { throw new RuntimeError('Variable "page" does not exist.', 72, $this->source); })()) + 1)]), "html", null, true);
            yield "\" class=\"btn btn secondary\">Page suivante</a>
  ";
        }
        // line 74
        yield "
</div>

";
        // line 78
        yield "
<!--div-->

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "admin/habita/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  164 => 78,  159 => 74,  153 => 72,  151 => 71,  148 => 70,  142 => 68,  140 => 67,  134 => 63,  119 => 54,  115 => 53,  110 => 51,  106 => 50,  101 => 47,  97 => 46,  91 => 44,  81 => 43,  70 => 0,  60 => 41,  37 => 39,);
    }

    public function getSourceContext()
    {
        return new Source("{# {% extends 'admin/admin.html.twig' %}
 
{% block title \"Tous les habitats\" %}


{% block body %}
 <p> <a class=\"btn btn-primary btn-sm\" href=\"{{ url('admin.habitat.create') }}\">Ajouter un habitat</a></p>

<table class=\"table\">
<thead>
  <tr>
    <th>Titre</th>
    <th>Catégorie</th>
    <th style=\"width: 200px\">Actions</th>
  </tr>
</thead>
<tbody>
{% for habitat in habitats %}
  <tr>
    <td> <a href=\"{{ url('admin.habitat.edit', {id: habitat.id}) }}\">{{habitat.title}}</a></td>
    <td>  {{habitat.category.name | default('') }}  </td>
    <td> 
    <div class=\"d-flex gap-1\">
    <a class=\"btn btn-primary btn-sm\" href=\"{{ url('admin.habitat.edit', {id: habitat.id}) }}\">Editer</a>
    <form action=\"{{ path('admin.habitat.delete', {id: habitat.id}) }}\" method=\"post\">
      <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
      <button type=\"submit\" class=\"btn btn-danger btn-sm\">Supprimer</button>
    </form>
    </div>
    </td>
  </tr>
   {% endfor %}
<tbody>
</table>
{% endblock %} #}



{% extends 'admin/admin.html.twig' %}

{% block title \"Tous les habitats\" %}

{% block body %}
 <p> <a class=\"btn btn-primary btn-sm\" href=\"{{ url('admin.habitat.create') }}\">Ajouter un habitat</a></p>
<div class=\"row\">
    {% for habitat in habitats %}
    <div class=\"col-md-4 mb-4\">
        <div class=\"card\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">{{ habitat.title }}</h5>
                <p class=\"card-text\">{{ habitat.category.name | default('') }}</p>
                <div class=\"d-flex justify-content-between align-items-center\">
                    <a href=\"{{ path('admin.habitat.edit', {id: habitat.id}) }}\" class=\"btn btn-primary\">Editer</a>
                    <form action=\"{{ path('admin.habitat.delete', {id: habitat.id}) }}\" method=\"post\">
                        <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                        <button type=\"submit\" class=\"btn btn-danger\">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {% endfor %}
</div>

<div class=\"d-flex justify-content-between\">

  {% if page > 1 %}
    <a href=\"{{ path('admin.habitat.index', {page:page - 1})}}\" class=\"btn btn secondary\">Page précédente</a>
  {% endif %}

  {% if page < maxPage %}
    <a href=\"{{ path('admin.habitat.index', {page:page + 1})}}\" class=\"btn btn secondary\">Page suivante</a>
  {% endif %}

</div>

{# {% endif %} #}

<!--div-->

{% endblock %}

", "admin/habita/index.html.twig", "/home/benou/framework-symfony/Symfony/AtypikHouse/templates/admin/habita/index.html.twig");
    }
}
