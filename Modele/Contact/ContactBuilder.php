<?php

namespace R401\TP5\Modele\Contact;

class ContactBuilder {
    private ?int $contactId = null;
    private string $nom;
    private string $prenom;
    private string $adresse;
    private string $codePostal;
    private string $ville;
    private string $telephone;

    public function build(): Contact {
        return new Contact($this->nom, $this->prenom, $this->adresse, $this->codePostal, $this->ville, $this->telephone, $this->contactId);
    }

    public function contactId(int $contactId): ContactBuilder {
        $this->contactId = $contactId;
        return $this;
    }


    public function nom(string $nom): ContactBuilder {
        $this->nom = $nom;
        return $this;
    }

    public function prenom(string $prenom): ContactBuilder {
        $this->prenom = $prenom;
        return $this;
    }

    public function adresse(string $adresse): ContactBuilder {
        $this->adresse = $adresse;
        return $this;
    }

    public function codePostal(string $codePostal): ContactBuilder {
        $this->codePostal = $codePostal;
        return $this;
    }

    public function ville(string $ville): ContactBuilder {
        $this->ville = $ville;
        return $this;
    }

    public function telephone(string $telephone): ContactBuilder {
        $this->telephone = $telephone;
        return $this;
    }
}

