English
# CCC Two Click (Joomla Module)

CCC Two Click embeds external iframes only after explicit consent. Ideal for maps, videos, and other third‑party widgets where privacy matters.

## Requirements
- Joomla 5.4+

## Installation
1. Install the module ZIP via Joomla Extension Manager.
2. Publish the module in a module position.
3. If you install manually from this repo, copy `modules/mod_ccctwoclick/media/` to `media/mod_ccctwoclick/`.
4. Clear Joomla and browser caches.

## Quick Start
1. Set **iFrame source** and **iFrame title**.
2. Add **Content before** (explains the privacy impact).
3. Choose **Consent control**: toggle or button.
4. Optional: set **Privacy link** and **Extended privacy details**.
5. Save and test.

## Consent Storage
- **Store consent**: On/Off (off means consent is required on every page load).
- **Scope**: per module / per domain / global.
- **Remember across sessions**: sessionStorage vs localStorage.

## Layout Options
- **Card position**: top / overlay / bottom (before consent), top / bottom (after consent).
- **Privacy bar layout**: separate or integrated into the card.
- **Privacy bar position** (when separate): top / overlay / bottom / none (before), top / bottom / none (after).

## Privacy Link Rules
Only `http(s)`, `mailto`, `tel`, relative URLs, or anchors are accepted.

## Troubleshooting
- **No styling**: ensure module CSS is enabled or add custom styles.
- **Nothing happens on click**: ensure assets exist in `media/mod_ccctwoclick/` and clear cache.
- **Wrong size**: disable responsive mode if width is `%`, or use fixed dimensions.

---
German
# CCC Two Click (Joomla Modul)

CCC Two Click bindet externe iFrames erst nach ausdruecklicher Zustimmung ein. Ideal fuer Karten, Videos und andere Drittanbieter‑Widgets.

## Voraussetzungen
- Joomla 5.4+

## Installation
1. Modul‑ZIP im Joomla Extension Manager installieren.
2. Modul in einer Position veroeffentlichen.
3. Bei manueller Installation aus diesem Repo: `modules/mod_ccctwoclick/media/` nach `media/mod_ccctwoclick/` kopieren.
4. Joomla‑ und Browser‑Cache leeren.

## Schnellstart
1. **iFrame Quelle** und **iFrame Titel** setzen.
2. **Inhalt davor** verfassen (Datenschutz‑Hinweis).
3. **Consent‑Steuerung** waehlen: Toggle oder Button.
4. Optional: **Datenschutz‑Link** und **erweiterte Details** setzen.
5. Speichern und testen.

## Consent‑Speicherung
- **Consent speichern**: An/Aus (aus = Zustimmung bei jedem Seitenaufruf neu).
- **Scope**: pro Modul / pro Domain / global.
- **Ueber Sitzungen merken**: sessionStorage oder localStorage.

## Layout‑Optionen
- **Card‑Position**: oben / overlay / unten (vor Consent), oben / unten (nach Consent).
- **Privacy‑Bar Layout**: separat oder integriert in die Card.
- **Privacy‑Bar Position** (bei separatem Layout): oben / overlay / unten / keine (vorher), oben / unten / keine (nachher).

## Regeln fuer den Datenschutz‑Link
Erlaubt sind nur `http(s)`, `mailto`, `tel`, relative URLs oder Anker.

## Fehlerbehebung
- **Kein Styling**: Modul‑CSS aktivieren oder eigene Styles nutzen.
- **Keine Reaktion**: sicherstellen, dass Assets in `media/mod_ccctwoclick/` vorhanden sind, Cache leeren.
- **Falsche Groesse**: Responsive deaktivieren bei Prozentbreite oder feste Masse nutzen.
