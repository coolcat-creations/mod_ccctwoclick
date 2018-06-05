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

