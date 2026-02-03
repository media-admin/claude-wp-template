cd cms

# 1. Hero Slides erstellen
echo "Creating Hero Slides..."
wp post create \
  --post_type=slide \
  --post_title='Willkommen bei unserer Agency' \
  --post_status=publish

wp post create \
  --post_type=slide \
  --post_title='Innovation & Kreativität' \
  --post_status=publish

wp post create \
  --post_type=slide \
  --post_title='Ihre Vision, unsere Expertise' \
  --post_status=publish

# 2. FAQ erstellen
echo "Creating FAQs..."
wp post create \
  --post_type=faq \
  --post_title='Was kostet ein Projekt?' \
  --post_content='Die Kosten variieren je nach Umfang. Ein kleines Projekt startet bei 5.000€, größere Projekte können 20.000€+ kosten.' \
  --post_status=publish

wp post create \
  --post_type=faq \
  --post_title='Wie lange dauert die Umsetzung?' \
  --post_content='Ein typisches Projekt dauert 4-8 Wochen, abhängig von der Komplexität und den Anforderungen.' \
  --post_status=publish

wp post create \
  --post_type=faq \
  --post_title='Bieten Sie auch Support an?' \
  --post_content='Ja, wir bieten verschiedene Support-Pakete an. Von Basic Support bis hin zu Premium-Wartungsverträgen.' \
  --post_status=publish

wp post create \
  --post_type=faq \
  --post_title='Arbeiten Sie remote oder vor Ort?' \
  --post_content='Wir arbeiten flexibel - sowohl remote als auch vor Ort, je nach Projektanforderung.' \
  --post_status=publish

# 3. Team Members erstellen
echo "Creating Team Members..."
wp post create \
  --post_type=team \
  --post_title='Max Mustermann' \
  --post_content='Mit über 10 Jahren Erfahrung in der Webentwicklung leitet Max unser Entwicklerteam und sorgt für technische Exzellenz.' \
  --post_status=publish

wp post create \
  --post_type=team \
  --post_title='Sarah Schmidt' \
  --post_content='Sarah ist unsere Lead Designerin mit einem Auge für Details und Benutzererfahrung.' \
  --post_status=publish

wp post create \
  --post_type=team \
  --post_title='Tom Weber' \
  --post_content='Als Marketing-Experte entwickelt Tom Strategien, die unsere Kunden erfolgreich machen.' \
  --post_status=publish

# 4. Projects erstellen
echo "Creating Projects..."
wp post create \
  --post_type=project \
  --post_title='E-Commerce Platform' \
  --post_excerpt='Moderne Online-Shop Lösung mit React und WordPress' \
  --post_content='Ein vollständig responsives E-Commerce System mit über 1000 Produkten.' \
  --post_status=publish

wp post create \
  --post_type=project \
  --post_title='Corporate Website' \
  --post_excerpt='Unternehmenswebsite mit CMS für einfache Verwaltung' \
  --post_content='Eine professionelle Unternehmenswebsite mit modernem Design und einfacher Content-Verwaltung.' \
  --post_status=publish

wp post create \
  --post_type=project \
  --post_title='Mobile App Integration' \
  --post_excerpt='API-basierte mobile App mit WordPress Backend' \
  --post_content='Native mobile App mit WordPress als Backend-System.' \
  --post_status=publish

# 5. Testimonials erstellen
echo "Creating Testimonials..."
wp post create \
  --post_type=testimonial \
  --post_title='Anna Müller' \
  --post_content='Die Zusammenarbeit war hervorragend! Unser neuer Online-Shop übertrifft alle Erwartungen. Professionell, pünktlich und kreativ.' \
  --post_status=publish

wp post create \
  --post_type=testimonial \
  --post_title='Peter Fischer' \
  --post_content='Kompetentes Team, das genau versteht was der Kunde braucht. Unsere Website ist jetzt modern, schnell und benutzerfreundlich.' \
  --post_status=publish

wp post create \
  --post_type=testimonial \
  --post_title='Lisa Wagner' \
  --post_content='Exzellenter Service vom ersten Kontakt bis zum Launch. Die technische Umsetzung ist top und das Design einfach wow!' \
  --post_status=publish

# 6. Services erstellen
echo "Creating Services..."
wp post create \
  --post_type=service \
  --post_title='Webentwicklung' \
  --post_excerpt='Moderne Websites & Web-Applikationen' \
  --post_content='Wir entwickeln performante und skalierbare Weblösungen mit modernsten Technologien.' \
  --post_status=publish

wp post create \
  --post_type=service \
  --post_title='UI/UX Design' \
  --post_excerpt='Benutzerzentrierte Interface-Gestaltung' \
  --post_content='Wir designen intuitive und ansprechende Benutzeroberflächen die konvertieren.' \
  --post_status=publish

wp post create \
  --post_type=service \
  --post_title='Digital Marketing' \
  --post_excerpt='SEO, Social Media & Content Marketing' \
  --post_content='Wir helfen Ihnen online sichtbar zu werden und Ihre Zielgruppe zu erreichen.' \
  --post_status=publish

echo "✅ Demo data created!"
echo ""
echo "Next steps:"
echo "1. Go to Pages → Add New"
echo "2. Select Template: Page Builder"
echo "3. Add sections and select the created content"
echo ""

cd ..