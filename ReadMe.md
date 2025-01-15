## commandes si retard
# utile
lancer serveur
```scomposer update```
```symfony serve```

stopper
```symfony server:stop```

construire les assets
```npm run dev```

créer une entité
```symfony console make:entity NAME```

migration
```symfony console make:migration```
```symfony console doctrine:migrations:migrate```

faire migration quand seul dans bd 
```symfony console doctrine:schema:update --force```

formulaire
```symfony console make:form```

crud
```symfony console make:crud```

# pb de migrations 
```symfony console doctrine:migrations:list```
```symfony console doctrine:migrations:version --add DoctrineMigrations\Version---```
```symfony console doctrine:migrations:migrate```

# bd 
avec docker :
```symfony console make:docker:database```
```docker-compose up -d database```

sans: 
```symfony console doctrine:database:create```
(```DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"```) dans .env

# créer bd
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

# créer formulaire 

```Symfony console make:form```
CoasterType
Coaster

# à ajouter dans template/coast/add.html.twig

{% extends "base.html.twig" %}

{% block body %}
{{ form_start(coasterForm) }}
    {{form_widget(coasterForm)}}
    {# button:submit.btn.btn-primary #}
    <button type="submit" class="btn btn-primary">Ajouter</button>
{{ form_end(coasterForm) }}
{% endblock %}

# scss
backgroung-color: rgba(var(--bs-tertiary-bg-rgb),0.6)

# erreur non converti en string (dans le chemin donné App/Entity/...)
public function __toString(): string
{
    return $this->name;
}

# entity categorie
categories
ManyToMany
Category

# sites
bouton select: https://slimselectjs.com/
arreire plan: https://www.gradientmagic.com/
icon: https://fontawesome.com/
icons: https://icons.getbootstrap.com/


# grouper par pays
'group_by' => function(Park $entity) {
    return $entity->getCountry();
},

# tp5 A REFAIRE

CoasterRepository il faut mettre security mais tjr souligné en rouge ? (même si pas souligné ne fonctionne pas)


