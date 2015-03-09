<?php
date_default_timezone_set('Europe/Berlin');

/**
 * Während der Entwicklung wird die BASEURL automatisch erraten
 * In Produktionssituationen sollte manuell eine konfiguriert werden um Überraschungen zu vermeiden
 */
if($_SERVER['HTTP_HOST'] != 'localhost')
	$GLOBALS['CONFIG']['BASEURL'] = 'http://streaming.media.ccc.de/';


$GLOBALS['CONFIG']['CONFERENCE'] = array(
	/**
	 * Titel der Konferenz (kann Leer- und Sonderzeichen enthalten)
	 * Dieser im Seiten-Header, im <title>-Tag, in der About-Seite und ggf. ab weiteren Stellen als
	 * Anzeigetext benutzt
	 */
	'TITLE' => 'FOSSGIS-Konferenz 2015',

	/**
	 * Veranstalter
	 * Wird für den <meta name="author">-Tag verdet. Wird diese Zeile auskommentiert, wird kein solcher
	 * <meta>-Tag generiert.
	 */
	'AUTHOR' => 'FOSSGIS e.V.',

	/**
	 * Beschreibungstext
	 * Wird für den <meta name="description">-Tag verdet. Wird diese Zeile auskommentiert, wird kein solcher
	 * <meta>-Tag generiert.
	 */
	'DESCRIPTION' => 'Video Live-Streaming von der FOSSGIS-Konferenz 2015',

	/**
	 * Schlüsselwortliste, Kommasepariert
	 * Wird für den <meta name="keywords">-Tag verdet. Wird diese Zeile auskommentiert, wird kein solcher
	 * <meta>-Tag generiert.
	 */
	'KEYWORDS' => 'FOSSGIS, FOSSGIS-Konferenz, 2015, FOSSGIS-Konferenz 2015, Open Source, GIS, Konferenz, Geoinformatik, OpenStreetMap, Video, Media, Streaming, Live',

	/**
	 * HTML-Code für den Footer (z.B. für spezielle Attribuierung mit <a>-Tags)
	 * Sollte üblicherweise nur Inline-Elemente enthalten
	 * Wird diese Zeile auskommentiert, wird die Standard-Attribuierung für (c3voc.de) verwendet
	 */
	//'FOOTER_HTML' => 'by <a href="https://c3voc.de">c3voc</a>',

	/**
	 * HTML-Code für den Banner (nur auf der Startseite, direkt unter dem Header)
	 * wird üblicherweise für KeyVisuals oder Textmarke verwendet (vgl. Blaues
	 * Wischiwaschi auf http://media.ccc.de/)
	 *
	 * Dieser HTML-Block wird üblicherweise in der main.less speziell für die
	 * Konferenz umgestaltet.
	 *
	 * Wird diese Zeile auskommentiert, wird kein Banner ausgegeben.
	 */
	'BANNER_HTML' => '
		<div class="container">
			<figure>
				<img src="assets/img/schloss.jpg" width="1367" height="463" alt="Schloss zu Münster" />
				<figcaption>Photo: WWU/Peter Grewer</figcaption>
			</figure>
			<h2 class="hidden-xs">Willkommen zur FOSSGIS-Konferenz 2015</h2>
		</div>
	',
);

/**
 * Konfiguration der Stream-Übersicht auf der Startseite
 */
$GLOBALS['CONFIG']['OVERVIEW'] = array(
	/**
	 * Abschnitte aud der Startseite und darunter aufgeführte Räume
	 * Es können beliebig neue Gruppen und Räume hinzugefügt werden
	 *
	 * Die Räume müssen in $GLOBALS['CONFIG']['ROOMS'] konfiguriert werden,
	 * sonst werden sie nicht angezeigt.
	 */
	'GROUPS' => array(
		'Vortragsräume' => array(
			'S10',
			'S2',
			'S1',
		),

		'Webcam' => array(
			'foyer'
		),
	),

	/**
	 * Link zu den Recordings
	 * Wird diese Zeile auskommentiert, wird der Link nicht angezeigt
	 */
	'RELEASES' => 'http://www.fossgis.de/konferenz/2015/programm/events.de.html',

	/**
	 * Link zu einer (externen) ReLive-Übersichts-Seite
	 * Wird diese Zeile auskommentiert, wird der Link nicht angezeigt
	 */
	//'RELIVE' => 'http://vod.c3voc.de/',

	/**
	 * Alternativ kann ein ReLive-Json konfiguriert werden, um die interne
	 * ReLive-Ansicht zu aktivieren.
	 *
	 * Wird beides aktiviert, hat der externe Link Vorrang!
	 * Wird beides auskommentiert, wird der Link nicht angezeigt
	 */
	//'RELIVE_JSON' => 'http://vod.c3voc.de/index.json',
);



/**
 * Liste der Räume (= Audio & Video Produktionen, also auch DJ-Sets oä.)
 */
$GLOBALS['CONFIG']['ROOMS'] = array(
	/**
	 * Array-Key ist der Raum-Slug, der z.B. auch zum erstellen der URLs,
	 * in $GLOBALS['CONFIG']['OVERVIEW'] oder im Feedback verwendet wird.
	 */
	'S10' => array(
		/**
		 * Angezeige-Name
		 */
		'DISPLAY' => 'S10 (GIS I)',

		/**
		 * Vefügbare Streaming-Formate
		 * Die Formate müssen in $GLOBALS['CONFIG']['FORMATS'] benannt sein, es
		 * können jedoch über die Config keine neuen erfunden werden; dazu sind
		 * Änderungen am Code erforderlich.
		 */
		'FORMATS' => array(
			'rtmp-sd',
			'hls-sd',
			'webm-sd',
			'audio-mp3', 'audio-opus',
		),

		/**
		 * ID des Video/Audio-Streams. Die Stream-ID ist davon abhängig, welches
		 * Event-Case in welchem Raum aufgebaut wird und wird üblicherweise von
		 * s1 bis s5 durchnummeriert.
		 */
		'STREAM' => 's2',

		/**
		 * Stream-Vorschaubildchen auf der Übersichtsseite anzeigen
		 * Damit das funktioniert muss der entsprechende runit-Task auf dem
		 * CDN-Quell-Host (live.ber) laufen.
		 */
		'PREVIEW' => true,

		/**
		 * Übersetzungstonspur aktivieren
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist werden nur
		 * die native-Streams verwendet, andernfalls wird native und translated
		 * angeboten und auch für beide Tonspuren eine Player-Seite angezeigt.
		 *
		 * Der Spezialwert 'stereo' (oder ein beliebiger anderer String) kann
		 * verwendet werden, um statt s1_native_sd Streamnamen in der Art von
		 * s1_<string>_sd, also z.B. s1_stereo_sd zu benutzen. Abgesehen von den
		 * anderen Streamnamen verhält sich die Seite, als wäre false gesetzt.
		 */
		'TRANSLATION' => false,

		/**
		 * Fahrplan-Ansicht auf der Raum-Seite aktivieren (boolean)
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * wird der Raum nicht im Fahrplan gesucht und auch auf der Startseite
		 * findet keine Darstellung statt.
		 *
		 * Ebenso können alle Fahrplan-Funktionialitäten durch auskommentieren
		 * des globalen $GLOBALS['CONFIG']['SCHEDULE']-Blocks deaktiviert werden
		 */
		'SCHEDULE' => true,

		/**
		 * Name des Raums im Fahrplan
		 * Wenn diese Zeile auskommentiert ist wird der Raum-Slug verwendet
		 */
		//'SCHEDULE_NAME' => 'S10',

		/**
		 * Feedback anzeigen (boolean)
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * taucht der Raum auch im globalen Feedback-Formular nicht auf.
		 *
		 * Ebenso können alle Feedback-Funktionialitäten durch auskommentieren
		 * des globalen $GLOBALS['CONFIG']['FEEDBACK']-Blocks deaktiviert werden
		 */
		'FEEDBACK' => true,

		/**
		 * Subtitles-Player aktivieren (boolean)
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * wird der Subtitles-Button und die damit verbundenen Funktionen deaktiviert.
		 *
		 * Ebenso können alle Subtitles-Funktionialitäten durch auskommentieren
		 * des globalen $GLOBALS['CONFIG']['SUBTITLES']-Blocks deaktiviert werden
		 */
		'SUBTITLES' => false,

		/**
		 * IRC-Link aktivieren (boolean)
		 *
		 * Solange Twitter oder IRC aktiviert ist, wird ein "Chat"-Tab mit den
		 * jeweiligen Links angezeigt.
		 *
		 * Ist dieses Feld auf true gesetzt, wird ein irc://-Link angezeigt.
		 * WebIrc wird nach dem Congress nicht mehr unterstützt ;)
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * wird kein IRC-Link angezeigt
		 *
		 * Ebenso können alle IRC-Links durch auskommentieren
		 * des globalen $GLOBALS['CONFIG']['IRC']-Blocks deaktiviert werden
		 */
		'IRC' => true,

		/**
		* Mit dem Angaben in diesem Block können die Vorgaben aus dem
		* globalen $GLOBALS['CONFIG']['IRC'] Block überschrieben werden.
		*
		* Der globale $GLOBALS['CONFIG']['IRC']-Block muss trotzdem existieren,
		* da sonst überhaupt kein IRC-Link erzeugt wird. (ggf. einfach `= true` setzen)
		*/
		//'IRC_CONFIG' => array(
		//	'DISPLAY' => '#31C3-hall-1 @ hackint',
		//	'URL'     => 'irc://irc.hackint.eu:6667/31C3-hall-1',
		//),

		/**
		 * Twitter-Link aktivieren (boolean)
		 *
		 * Ist dieses Feld auf true gesetzt, wird ein Link zu Twitter angezeigt.
		 *
		 * Solange Twitter oder IRC aktiviert ist, wird ein "Chat"-Tab mit den
		 * jeweiligen Links angezeigt.
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * wird kein Twitter-Link angezeigt
		 *
		 * Ebenso können alle Twitter-Links durch auskommentieren
		 * des globalen $GLOBALS['CONFIG']['TWITTER']-Blocks deaktiviert werden
		 **/
		'TWITTER' => true,

		/**
		* Mit dem Angaben in diesem Block können die Vorgaben aus dem
		* globalen $GLOBALS['CONFIG']['TWITTER'] Block überschrieben werden.
		*
		* Der globale $GLOBALS['CONFIG']['TWITTER']-Block muss trotzdem existieren,
		* da sonst überhaupt kein IRC-Link erzeugt wird. (ggf. einfach `= true` setzen)
		*/
		//'TWITTER_CONFIG' => array(
		//	'DISPLAY' => '#hall1 @ twitter',
		//	'TEXT'    => '#31C3 #hall1',
		//),
	),

	'S2' => array(
		'DISPLAY' => 'S2 (GIS II)',
		'FORMATS' => array(
			'rtmp-sd',
			'hls-sd',
			'webm-sd',
			'audio-mp3', 'audio-opus',
		),
		'STREAM' => 's3',
		'PREVIEW' => true,
		'SCHEDULE' => true,
		'FEEDBACK' => true,
		'IRC' => true,
		'TWITTER' => true,
	),

	'S1' => array(
		'DISPLAY' => 'S3 (OSM)',
		'FORMATS' => array(
			'rtmp-sd',
			'hls-sd',
			'webm-sd',
			'audio-mp3', 'audio-opus',
		),
		'STREAM' => 's4',
		'PREVIEW' => true,
		'SCHEDULE' => true,
		'FEEDBACK' => true,
		'IRC' => true,
		'TWITTER' => true,
	),

	'foyer' => array(
		'DISPLAY' => 'Foyer (Ausstellung)',
		'FORMATS' => array(
			'rtmp-hd',
			'hls-hd',
			'webm-hd',
		),
		'STREAM' => 'cam',
		'PREVIEW' => true,
		'IRC' => true,
		'TWITTER' => true,
	),
);



/**
 * Konfigurationen zum Konferenz-Fahrplan
 * Wird dieser Block auskommentiert, werden alle Fahrplan-Bezogenen Features deaktiviert
 */
$GLOBALS['CONFIG']['SCHEDULE'] = array(
	/**
	 * URL zum Fahrplan-XML
	 *
	 * Diese URL muss immer verfügbar sein, sonst können kann die Programm-Ansicht
	 * aufhören zu funktionieren. Wenn die Quelle unverlässlich ist ;) sollte ein
	 * externer HTTP-Cache vorgeschaltet werden.
	 */
	'URL' => 'http://www.fossgis.de/konferenz/2015/programm/schedule.de.xml',

	/**
	 * APCU-Cache-Zeit in Sekunden
	 * Wird diese Zeile auskommentiert, werden die apc_*-Methoden nicht verwendet und
	 * der Fahrplan bei jedem Request von der Quelle geladen und geparst
	 */
	'CACHE' => 30*60,

	/**
	 * Skalierung der Programm-Vorschau in Sekunden pro Pixel
	 */
	'SCALE' => 7,

	/**
	 * Simuliere das Verhalten als wäre die Konferenz bereits heute
	 *
	 * Diese folgende Beispiel-Zeile Simuliert, dass das
	 * Konferenz-Datum 2014-12-29 auf den heutigen Tag 2015-02-24 verschoben ist.
	 */
	//'SIMULATE_OFFSET' => strtotime(/* Conference-Date */ '2015-03-11') - strtotime(/* Today */ '2015-03-03'),
	'SIMULATE_OFFSET' => 0,
);



/**
 * Konfiguration des Feedback-Formulars
 *
 * Wird dieser Block auskommentiert, wird das gesamte Feedback-System deaktiviert
 */
$GLOBALS['CONFIG']['FEEDBACK'] = array(
	/**
	 * DSN zum abspeichern der eingegebenen Daten
	 * die Datenbank muss eine Tabelle enthaltem, die dem in `lib/schema.sql` angegebenen
	 * Schema entspricht.
	 *
	 * Achtung vor Dateirechten: Bei SQLite reicht es nicht, wenn wer Webseiten-Benutzer
	 * die .sqlite3-Datei schreiben darf, er muss auch im übergeordneten Order neue
	 * (Lock-)Dateien anlegen dürfen
	 */
	'DSN' => 'sqlite:/var/streaming-feedback/feedback.sqlite3',

	/**
	 * Login-Daten für die /feedback/read/-Seite, auf der eingegangenes
	 * Feedback gelesen werden kann.
	 *
	 * Durch auskommentieren der beiden Optionen wird diese Seite komplett deaktiviert,
	 * es kann dann nur noch durch manuelle Inspektion der .sqlite3-Datei auf das Feedback
	 * zugegriffen werden.
	 */
	'USERNAME' => 'winke',
	'PASSWORD' => 'katze',
);

/**
 * Konfiguration des L2S2-Systems
 * https://github.com/c3subtitles/L2S2
 *
 * Wird dieser Block auskommentiert, wird das gesamte Subtitle-System deaktiviert
 */
//$GLOBALS['CONFIG']['SUBTITLES'] = array(
//	/**
//	 * URL des L2S2-Servers
//	 */
//	'URL' => 'http://subtitles.c3voc.de/',
//);

/**
 * Globale Konfiguration der IRC-Links.
 *
 * Wird dieser Block auskommentiert, werden keine IRC-Links mehr erzeugt. Sollen die
 * IRC-Links für jeden Raum einzeln konfiguriert werden, muss dieser Block trotzdem
 * existieren sein. ggf. einfach auf true setzen:
 *
 *   $GLOBALS['CONFIG']['IRC'] = true
 */
$GLOBALS['CONFIG']['IRC'] = array(
	/**
	 * Anzeigetext für die IRC-Links.
	 *
	 * %s wird durch den Raum-Slug ersetzt.
	 * Ist eine weitere Anpassung erfoderlich, kann ein IRC_CONFIG-Block in der
	 * Raum-Konfiguration zum Überschreiben dieser Angaben verwendet werden.
	 */
	'DISPLAY' => '#fossgis @ freenode',

	/**
	 * URL für die IRC-Links.
	 *
	 * %s wird durch den Raum-Slug ersetzt.
	 * Eine Anpassung kann ebenfalls in der Raum-Konfiguration vorgenommen werden.
	 */
	'URL' => 'https://kiwiirc.com/client/irc.freenode.net/#fossgis',
);

/**
 * Globale Konfiguration der Twitter-Links.
 *
 * Wird dieser Block auskommentiert, werden keine Twitter-Links mehr erzeugt. Sollen die
 * Twitter-Links für jeden Raum einzeln konfiguriert werden, muss dieser Block trotzdem
 * existieren sein. ggf. einfach auf true setzen:
 *
 *   $GLOBALS['CONFIG']['TWITTER'] = true
 */
$GLOBALS['CONFIG']['TWITTER'] = array(
	/**
	 * Anzeigetext für die Twitter-Links.
	 *
	 * %s wird durch den Raum-Slug ersetzt.
	 * Ist eine weitere Anpassung erfoderlich, kann ein TWITTER_CONFIG-Block in der
	 * Raum-Konfiguration zum Überschreiben dieser Angaben verwendet werden.
	 */
	'DISPLAY' => '#FOSSGIS2015 @ twitter',

	/**
	 * Vorgabe-Tweet-Text für die Twitter-Links.
	 *
	 * %s wird durch den Raum-Slug ersetzt.
	 * Eine Anpassung kann ebenfalls in der Raum-Konfiguration vorgenommen werden.
	 */
	'TEXT' => ' @FOSSGIS2015',
);




/**
 * Beschreibung der Streaming-Formate
 *
 * Achtung: Über diese Sektion können keine zusätzlichen Formate erstellt werden -- dazu
 * sind Code-Anpassungen erforderlich.
 *
 * In diesem Abschnitt können ausschließlich die Anzeigetexte für die verschiedenen
 * Streaming-Formate bearbeitet werden. Für jedes Streamingformat das in einem Raum
 * verwendet wird müssen hier Texte hinterlegt sein.
 */
$GLOBALS['CONFIG']['FORMAT'] = array(
	'rtmp-sd' => '1024x576, h264+AAC im FLV-Container via RTMP, 800 kBit/s',
	'rtmp-hd' => '1920x1080, h264+AAC im FLV-Container via RTMP, 3 MBit/s',

	'hls-sd' => '1024x576, h264+AAC im MPEG-TS-Container via HTTP, 800 kBit/s',
	'hls-hd' => '1920x1080, h264+AAC im MPEG-TS-Container via HTTP, 3 MBit/s',

	'webm-sd' => '1024x576, VP8+Vorbis in WebM, 800 kBit/s',
	'webm-hd' => '1920x1080, VP8+Vorbis in WebM, 3 MBit/s',

	'audio-mp3' => 'MP3-Audio, 96 kBit/s',
	'audio-opus' => 'Opus-Audio, 64 kBit/s',

	'music-mp3' => 'MP3-Audio, 320 kBit/s',
	'music-opus' => 'Opus-Audio, 128 kBit/s',

	'slides' => '1024x576, h264+AAC, <500 kBit/s',
);
