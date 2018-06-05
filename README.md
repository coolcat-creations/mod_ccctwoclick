# mod_ccctwoclick
This module reveals an external iframe only after user click. (2-Click Solution) to respect the privacy of the user.

This could be an iframe of a Facebook Like Box, a Facebook Comment Box, a Youtube Video or whatever.
Due to EU privacy law it might be obligatory to let the user decide if an external iframe is loaded or not.

In this module you can setup a specific iframe source and load it only,
when the user gives the permission by clicking a button.

![demo](https://raw.githubusercontent.com/coolcat-creations/mod_ccctwoclick/master/demo.gif)

## Available Settings
### Content before click

Background Image: Set up a Background Image that is shown, before the iframe is loaded. 
(That can be a blurry picture of the content that has to be revealed.)

Backgroundsize: Select the Background Size Property (Auto, Cover or Contain)

Content: You can add text here that will be shown below the image before the iframe is revealed.
(That can be an information like: "We respect your privacy, to reveal the Facebook Comment box click the button below")

Custom Button Text: The default button text is setup in the language file, if you want to use your custom language key or string just fill this input with your custom text.

Button Class: Add here a Button Class if needed

### Content after click:

Custom Button Text: The default button text is setup in the language file, if you want to use your custom language key or string just fill this input with your custom text.

Button Class: Add here a Button Class if needed

### Iframe Settings:
IFrame Source: Fill this input with the iframe link = A Link is an url to the embeded content and starts usually with https:// please do not fill here any iframe code or any plugin codes!

Example: https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2593.409168866908!2d11.073657616160999!3d49.457882979350806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479f57b0484a9207%3A0xa52e33decf29c9b!2sImperial+Castle+of+Nuremberg!5e0!3m2!1sen!2sde!4v1528203349104

Information: You get the exact iframe Link if you:
  Examples:
  Facebook: Get the Like Box Code and take just the URL from the provided iframe HTML
  Google Maps: Search the Location, click on share, then on embed, and take just the URL from the provided iframe HTML
  Youtube: Search ypur Video, click on share, then on embed, and take just the URL from the provided iframe HTML

Width: Set the iframe width here in px or %
Height: Set the iframe height here in px or %
(mind that the Facebook iframes have specific min/max sizes)

Frameborder: Setup the Frameborder of the iframe
Allow Fullscreen: Setup the fullscreen attribute to true or false
Allow Transparency: Setup the transparency attribute to true or false
Scrolling: Setup the scrolling attribute to yes or no
Load module css: Disable the Module CSS if needed

# mod_ccctwoclick
Dieses Modul zeigt ein externes iframe erst an, sobald der User auf einen Button geklickt hat (2-Klick Lösung). Dies kann zum Beispiel dazu verwendet werden um Datenschutzrichtlinien einzuhalten. 

Es könnte sich hierbei um eine Facebook Like Box, eine Facebook Kommentar Box, ein Youtubevideo, Google Map oder was auch immer handeln. In Anlehnung an die DSGVO könnte es verpflichtend sein, den Nutzer entscheiden zu lassen ob die Inhalte eines iFrames geladen werden oder nicht. 

In diesem Modul kann man einen iFrame link eingeben und laden lassen, sobald der Nutzer per Klick die Zustimmung dazu erteilt.

![demo](https://raw.githubusercontent.com/coolcat-creations/mod_ccctwoclick/master/demo.gif)

## Mögliche Einstellungen
### Inhalt vor dem Klick

Hintergrundbild: Hier kann ein Bild festgelegt werden, das angezeigt wird, bevor der iframe angezeigt wird. 
(Das könnte zum Beispiel ein verwaschenes Bild von dem Inhalt sein, der geladen werden soll - Aber bitte beachtet die Urheberrechte!)

Hintergrund-Größe: Hier kann eingestellt werden, in welcher Größe das Hintergrundbild eingebunden werden soll (Auto, Cover or Contain)

Inhalt: Hier kann man text eingeben der Über, Ober oder unter dem Bild angezeigt wird bevor der iFrame angezeigt wird.
(Zum Beispiel: "Wir respektieren den Schutz Ihrer Daten, um eine Verbindung zu Google Maps herzustellen und unsere Karte anzuzeigen klicken Sie auf den Button unter diesem Text.")

Eigener Button Text: Die Beschriftung für diesen Button ist in der Sprachdatei hinterlegt, wenn du deinen eigenen JText string verwenden willst, kannst du ihn hier eintragen oder einfach den Text eintragen, der auf dem Button stehen soll. 

Button Klasse: Hier kann eine eigene CSS Klasse für den Button hinterlegt werden (Beispiel: uk uk-btn-primary)

### Inhalt Nach dem Klick:

Inhalt: Hier kann man Text eingeben der Ober oder unter dem iFrame angezeigt wird.
(Zum Beispiel: "Wir respektieren den Schutz Ihrer Daten, um die Verbindung zu Google Maps wieder zu kappen, klicken Sie auf den Button unter diesem Text.")

Eigener Button Text: Die Beschriftung für diesen Button ist in der Sprachdatei hinterlegt, wenn du deinen eigenen JText string verwenden willst, kannst du ihn hier eintragen oder einfach den Text eintragen, der auf dem Button stehen soll. 

Button Klasse: Hier kann eine eigene CSS Klasse für den Button hinterlegt werden (Beispiel: uk uk-btn-primary)

### Iframe Einstellungen:
IFrame Source: Füge hier einen iFrame Link ein. Ein Link ist eine URL zu dem einzufügenden Inhalt und beginnt normalerweise mit https:// . Füge hier keinen iframe code und keine plugin codes ein, sondern einen Link! 

Beispiel: https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2593.409168866908!2d11.073657616160999!3d49.457882979350806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479f57b0484a9207%3A0xa52e33decf29c9b!2sImperial+Castle+of+Nuremberg!5e0!3m2!1sen!2sde!4v1528203349104

Information: Man bekommt diesen Link wenn man...
  Beispiele:
  Facebook: Erstelle dir bei Facebook einen Like Box Code und nehme die URL die in dem iframe HTML zur Vefügung gestellt wurde src="WAS ZWISCHEN DEN ANFÜHRUNGSZEICHEN STEHT"
  
  Google Maps: Suche die Location, klicke auf "Share" oder "Teilen", dann auf "embed" bzw. "einbetten" und nehme die URL die in dem iframe HTML zur Vefügung gestellt wurde src="WAS ZWISCHEN DEN ANFÜHRUNGSZEICHEN STEHT"
  
  Youtube: Suche das Video, klicke auf "Share" oder "Teilen", dann auf "embed" bzw. "einbetten" und nehme die URL die in dem iframe HTML zur Vefügung gestellt wurde src="WAS ZWISCHEN DEN ANFÜHRUNGSZEICHEN STEHT"

Breite: Einstellung der Breite des iFrames in px oder %
Höhe: Einstellung der Höhe des iFrames in px oder %
(Achtung: Facebook Like Boxen haben spezifische Mindest- und Maximalgrößen)

Frameborder: Hier kann der Frameborder eingestellt werden
Fullscreen: Hier kann das iFrame Fullscreen Attribut auf true oder false gesetzt werden
Transparenz: Hier kann das iFrame Transparency Attribut auf true oder false gesetzt werde
Scrolling: Hier kann das iFrame Scrolling Attribut auf yes oder no gesetzt werden
css laden: Hier kann auf Wunsch das mitgelieferte CSS deaktiviert werden.

##TODO
Seit Version 2.0.0 gibt es Positionierungs Parameter die hier noch beschrieben werden müssen

