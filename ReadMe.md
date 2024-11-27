## debut

symfony serve

## créer bd
name

80
non
maxSpeed
integer
yes
length
maxHeight
integer
yes
operating
boolean

## créer formulaire 

Symfony console make:form
CoasterType
Coaster

## à ajouter dans template/coast/add.html.twig

{% extends "base.html.twig" %}

{% block body %}
{{ form_start(coasterForm) }}
    {{form_widget(coasterForm)}}
    {# button:submit.btn.btn-primary #}
    <button type="submit" class="btn btn-primary">Ajouter</button>
{{ form_end(coasterForm) }}
{% endblock %}

# ensuite
<h1>Liste des coasters</h1>
