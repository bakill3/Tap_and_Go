<?php
$ip = $_SERVER['REMOTE_ADDR'];
//$ip_details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
//$user_country = $ip_details->country;

$translations = array(
	'en' => array(
		'nav_1' => 'Home',
		'nav_2' => 'Our Products',
		'nav_3' => 'Contact',

		'home_content' => 'Boost your business with greater engagement & visibility on Google and beyond...',
		'home_btn' => 'BUY NOW',
		'header_btn' => 'Shop Now',

		'section_1_title' => 'Elevate Your Business to the Top of Google with Tap&Go',
		'section_1_text' => 'With our Tap&Go cards, ensure immediate reviews on Google, boosting your SEO and placing your business at the forefront. A strategic move to amplify valuable customer interactions and strengthen your company\'s reputation.',
		'section_1_btn' => 'Our Products',

		'section_2_title' => 'Instant Reviews with a Simple NFC Swipe',
		'section_2_text' => 'Watch the video and see how a quick swipe of our NFC card allows customers to <b>instantly share</b> their 5-star experiences. Unlock <b>greater engagement</b>, improve <b>visibility on Google</b> and attract a wave of loyal customers. Simplify the feedback journey, enjoy the benefits and watch your business take off.',
		'section_2_btn' => 'Learn More',

		'section_3_title' => 'Why Choose Tap&Go?',
		'section_3_text' => 'Boost your visibility, engage more customers, and secure your spot at the top of Google rankings.',
		'section_3_benefit_1_title' => 'Ascend On Google',
		'section_3_benefit_1_text' => 'Boost your establishment\'s reputation, climb Google ranks, and magnetize new customers effortlessly.',
		'section_3_benefit_2_title' => 'Swipe & Review',
		'section_3_benefit_2_text' => 'Any smart device can instantly connect, streamlining the review process for your customers.',
		'section_3_benefit_3_title' => 'Professional Presence',
		'section_3_benefit_3_text' => 'Outshine competitors with modern tech, enhancing your business\'s professional appeal.',
		'section_3_benefit_4_title' => 'Real-Time Insights',
		'section_3_benefit_4_text' => 'Track interactions, understand your reach, and optimize your strategies with our data-driven insights.',

		'section_4_title' => 'Our Products',
		'section_4_btn' => 'Check Product',

		'section_5_title' => 'More Reviews, Better Business',
		'section_5_pack_1_title' => 'Basic Pack',
		'section_5_pack_1_subtitle' => 'Starting at',
		'section_5_pack_1_price' => '39,95 '.$currency,
		'section_5_pack_1_oldprice' => '59,95 '.$currency,
		'section_5_pack_1_cardnumbers' => '5 NFC Cards',
		'section_5_pack_1_benefit_1' => 'Seamless Google Review Integration',
		'section_5_pack_1_benefit_2' => 'Boost Customer Engagement',
		'section_5_pack_1_benefit_3' => 'Simple Setup and Use',
		'section_5_pack_1_benefit_4' => 'Quality Assurance',
		'section_5_packs_btn' => 'Get Yours',

		'section_5_pack_2_title' => 'Value Pack',
		'section_5_pack_2_subtitle' => 'Starting at',
		'section_5_pack_2_price' => '59,95 '.$currency,
		'section_5_pack_2_oldprice' => '99,95 '.$currency,
		'section_5_pack_2_cardnumbers' => '10 NFC Cards',
		'section_5_pack_2_benefit_1' => 'Effortless Google Review Collection',
		'section_5_pack_2_benefit_2' => 'Improve Customer Satisfaction',
		'section_5_pack_2_benefit_3' => 'Convenient for Multiple Locations',
		'section_5_pack_2_benefit_4' => 'Dependable and Durable Cards',

		'section_5_pack_3_title' => 'Premium Pack',
		'section_5_pack_3_subtitle' => 'Starting at',
		'section_5_pack_3_price' => '99,95 '.$currency,
		'section_5_pack_3_oldprice' => '159,95 '.$currency,
		'section_5_pack_3_cardnumbers' => '20 NFC Cards',
		'section_5_pack_3_benefit_1' => 'Streamline Review Process',
		'section_5_pack_3_benefit_2' => 'Enhance Business Reputation',
		'section_5_pack_3_benefit_3' => 'Ideal for Chains and Large Venues',
		'section_5_pack_3_benefit_4' => 'Optimal Value and Functionality',

		'new_section_title' => 'Unlock Insights with Powerful Statistics',
		'new_section_text' => 'Explore in-depth information exclusive to cardholders through our platform. From <b>card usage frequencies</b> to <b>review tracking</b>, our intuitive graphs provide valuable insights into customer engagement. Everything is available <b>free of charge</b> via our friendly login portal, available for free to all buyers of our cards.',

		'faq_title_1' => 'What are the Tap&Go Cards?',
		'faq_text_1' => 'The Tap&Go cards utilize the innovative NFC technology. By using them, you can obtain immediate reviews on Google, an effective strategy to enhance your SEO and stand out not only on Google but also on other search engines. Opting for the Tap&Go cards is a smart decision to intensify meaningful interactions with customers, strengthen your company\'s online reputation, and attract more clientele.',

		'faq_title_2' => 'How do the cards capture user usage statistics?',
		'faq_text_2' => 'Whenever a customer taps the Tap&Go Card with their mobile phone, they are immediately redirected to a Tap&Go page. This page collects various statistics from the customer\'s device, such as daily usage, the operating system, and the type of device, among others. After this registration, the customer is automatically directed to the review page of your establishment. All this data is made available, at no cost, to the buyers of our cards through our control panel/Dashboard.',

		'faq_title_3' => 'In what quantities can I purchase the Tap&Go Cards?',
		'faq_text_3' => 'Our Tap&Go Cards, equipped with NFC technology for evaluation, are sold in packs of 1, 5, 10, or 20 units. The larger the quantity purchased, the more advantageous the discount. Choose the package that best fits the needs and goals of your business.',

		'faq_title_4' => 'How secure are the data collection processes?',
		'faq_text_4' => 'Tap&Go places the utmost value on user privacy and security. Our data collection processes adhere to the latest security protocols, ensuring that the captured information remains confidential and is used exclusively for analytical purposes to benefit businesses.',

		'faq_title_5' => 'Do the Tap&Go cards have an expiration date?',
		'faq_text_5' => 'Regarding the validity of Tap&Go, you\'ll be pleased to know that for cards currently purchased, there is no expiration date. If you acquire your Tap&Go card now, it will remain valid indefinitely, providing continuous benefits for your business. However, we warn that this is our current policy, and in the future, we may change it for new purchases. So, if you\'re considering buying, take advantage of this benefit while it\'s available.',

		'faq_title_6' => 'Accessing Your Panel and Statistics',
		'faq_text_6' => '
		<p>
		View detailed statistics of your establishment through our 
		<a href="/dashboard" target="_blank" style="color: blue;">Panel</a>. 
		On this platform, you can:
		</p>
		<ul>
		<li>Track the daily and weekly use of the cards.</li>
		<li>Analyze visitor metrics, including the operating systems they use.</li>
		<li>Observe data through modern and easy-to-understand graphs.</li>
		<li>Update the background image associated with the redirection link of your cards, ensuring that the image of your establishment is always up-to-date.</li>
		</ul>
		<p>
		After completing your order, you will receive an email with a temporary password. Once you access the panel, we recommend that you change it to ensure maximum security.
		</p>
		',

		'add_cart_btn' => 'Add to Cart',

		'checkout_cart_title' => 'Your Cart',
		'checkout_title_1' => 'Delivery',

		'checkout_label_2' => 'First name',
		'checkout_label_3' => 'Last name',
		'checkout_label_4' => 'Email',
		'checkout_label_5' => 'Address',
		'checkout_label_6' => 'Establishment',
		'checkout_label_info_6' => 'Make sure this field matches the name of your Establishment (EG: restaurant, bar)',
		'checkout_label_7' => 'Country',
		'checkout_label_8' => 'Zip',

		'checkout_title_2' => 'Payment',
		'checkout_buy_button' => 'Finalize Payment',
		'checkout_final_info' => 'Upon successful order completion, you\'ll receive an email with details about your order, along with a temporary password to access your establishment\'s statistics on our <a href="/dashboard" target="_blank" style="color: blue;">Dashboard</a>.',

		'footer_slogan' => 'Tap, Review, Elevate - The Power at Your Fingertips.',
		'footer_about_us' => 'Tap&Go harnesses NFC technology to streamline customer feedback. Our user-friendly review cards enable real-time reviews, helping businesses improve their services and enhance customer engagement. Embrace the future of customer interaction with us.',

		'footer_link_1' => 'Home',
		'footer_link_2' => 'Shop',
		'footer_link_3' => 'Benefits',
		'footer_link_4' => 'Contact Us',
		'footer_link_5' => 'Instagram',

		'pack_1_title' => 'Single Pack',
		'pack_2_title' => 'Basic Pack',
		'pack_3_title' => 'Valued Pack',
		'pack_4_title' => 'Premium Pack',

		'pack_1_qnt' => '1 Card',
		'pack_2_qnt' => '5 Cards',
		'pack_3_qnt' => '10 Cards',
		'pack_4_qnt' => '20 Cards',

		'shipping_badge' => 'Free Worldwide Shipping',
		'select_offer' => 'Select your offer:',

		'cart_checkout_btn' => 'Checkout <i class="fa-solid fa-arrow-right" style="font-weight: bold;"></i>',
		'cart_remove_btn' => 'Remove',
		'cart_title_your' => 'Your Cart',
		'cart_no_items' => 'No items in the cart',

		'cart_stripe_text' => 'You will be forwarded to payment with Stripe.',
		'shipping_checkout_info' => 'FREE SHIPPING',

		'validate_first_name' => 'Please enter a valid first name.',
		'validate_last_name' => 'Please enter a valid last name.',
		'validate_email' => 'Please enter a valid email address.',
		'validate_establishment' => 'Please enter your establishment name.',
		'validate_country' => 'Please enter your country.',
		'validate_zip' => 'Please enter your ZIP code.',
		'validate_address' => 'Please enter your address.',
		'validation_failed' => 'Validation Failed',
		'validation_failed_btn' => 'Try Again',
		'black_friday' => 'BLACK FRIDAY - UP TO 50% OFF',

		'product_benefit_1' => 'Unlimited Usage for Collecting Reviews',
		'product_benefit_2' => 'Attract new Customers',
		'product_benefit_3' => 'Perfect for Any Business',
		'product_benefit_4' => 'Fast Delivery Worldwide',
		

	),
'fr' => array(	
	'nav_1' => 'Accueil',
	'nav_2' => 'Nos Produits',
	'nav_3' => 'Contact',

	'home_content' => 'Boostez votre entreprise avec une plus grande visibilité sur Google et au-delà...',
	'home_btn' => 'Acheter Maintenant',
	'header_btn' => 'Acheter Maintenant',

	'section_1_title' => 'Élevez votre entreprise au sommet de Google avec Tap&Go',
	'section_1_text' => 'Avec nos cartes Tap&Go, assurez-vous des avis immédiats sur Google, améliorant votre SEO et mettant votre entreprise au premier plan. Une démarche stratégique pour amplifier les interactions précieuses avec les clients et renforcer la réputation de votre entreprise.',
	'section_1_btn' => 'Nos Produits',

	'section_2_title' => 'Avis instantanés avec un simple balayage NFC',
	'section_2_text' => 'Regardez la vidéo et découvrez comment un rapide balayage de notre carte NFC permet aux clients de <b>partager instantanément</b> leurs expériences 5 étoiles. Débloquez une <b>plus grande engagement</b>, améliorez la <b>visibilité sur Google</b> et attirez une vague de clients fidèles. Simplifiez le parcours de feedback, profitez des avantages et regardez votre entreprise décoller.',
	'section_2_btn' => 'En savoir plus',

	'section_3_title' => 'Pourquoi choisir Tap&Go?',
	'section_3_text' => 'Augmentez votre visibilité, engagez davantage de clients et assurez-vous une place au sommet des classements Google.',
	'section_3_benefit_1_title' => 'Montez sur Google',
	'section_3_benefit_1_text' => 'Améliorez la réputation de votre établissement, grimpez dans les classements Google et attirez de nouveaux clients sans effort.',
	'section_3_benefit_2_title' => 'Balayez et Commentez',
	'section_3_benefit_2_text' => 'N\'importe quel appareil intelligent peut se connecter instantanément, simplifiant le processus de révision pour vos clients.',
	'section_3_benefit_3_title' => 'Présence professionnelle',
	'section_3_benefit_3_text' => 'Surpassez vos concurrents avec une technologie moderne, renforçant l\'attrait professionnel de votre entreprise.',
	'section_3_benefit_4_title' => 'Informations en temps réel',
	'section_3_benefit_4_text' => 'Suivez les interactions, comprenez votre portée et optimisez vos stratégies grâce à nos informations basées sur les données.',

	'section_4_title' => 'Nos Produits',
	'section_4_btn' => 'Vérifier le produit',

	'section_5_title' => 'Plus d\'avis, meilleure entreprise',
	'section_5_pack_1_title' => 'Pack de base',
	'section_5_pack_1_subtitle' => 'À partir de',
	'section_5_pack_1_price' => '39,95 '.$currency,
	'section_5_pack_1_oldprice' => '59,95 '.$currency,
	'section_5_pack_1_cardnumbers' => '5 cartes NFC',
	'section_5_pack_1_benefit_1' => 'Intégration transparente des avis Google',
	'section_5_pack_1_benefit_2' => 'Augmentez l\'engagement des clients',
	'section_5_pack_1_benefit_3' => 'Configuration et utilisation simples',
	'section_5_pack_1_benefit_4' => 'Assurance qualité',
	'section_5_packs_btn' => 'Prenez le vôtre',

	'section_5_pack_2_title' => 'Pack valeur',
	'section_5_pack_2_subtitle' => 'À partir de',
	'section_5_pack_2_price' => '59,95 '.$currency,
	'section_5_pack_2_oldprice' => '99,95 '.$currency,
	'section_5_pack_2_cardnumbers' => '10 cartes NFC',
	'section_5_pack_2_benefit_1' => 'Collecte d\'avis Google sans effort',
	'section_5_pack_2_benefit_2' => 'Améliorez la satisfaction des clients',
	'section_5_pack_2_benefit_3' => 'Pratique pour plusieurs emplacements',
	'section_5_pack_2_benefit_4' => 'Cartes fiables et durables',

	'section_5_pack_3_title' => 'Pack premium',
	'section_5_pack_3_subtitle' => 'À partir de',
	'section_5_pack_3_price' => '99,95 '.$currency,
	'section_5_pack_3_oldprice' => '159,95 '.$currency,
	'section_5_pack_3_cardnumbers' => '20 cartes NFC',
	'section_5_pack_3_benefit_1' => 'Simplifiez le processus d\'examen',
	'section_5_pack_3_benefit_2' => 'Améliorez la réputation de l\'entreprise',
	'section_5_pack_3_benefit_3' => 'Idéal pour les chaînes et les grands lieux',
	'section_5_pack_3_benefit_4' => 'Valeur et fonctionnalité optimales',

	'new_section_title' => 'Découvrez des informations avec des statistiques puissantes',
	'new_section_text' => 'Explorez des informations approfondies réservées aux détenteurs de cartes sur notre plateforme. Des <b>fréquences d\'utilisation des cartes</b> au <b>suivi des avis</b>, nos graphiques intuitifs fournissent des informations précieuses sur l\'engagement des clients. Tout est disponible <b>gratuitement</b> via notre portail de connexion convivial, gratuit pour tous les acheteurs de nos cartes.',

	'faq_title_1' => 'Qu\'est-ce que les cartes Tap&Go?',
	'faq_text_1' => 'Les cartes Tap&Go utilisent la technologie NFC innovante. En les utilisant, vous pouvez obtenir des avis immédiats sur Google, une stratégie efficace pour améliorer votre SEO et vous démarquer non seulement sur Google mais aussi sur d\'autres moteurs de recherche. Opter pour les cartes Tap&Go est une décision judicieuse pour intensifier les interactions significatives avec les clients, renforcer la réputation en ligne de votre entreprise et attirer davantage de clientèle.',

	'faq_title_2' => 'Comment les cartes capturent-elles les statistiques d\'utilisation des utilisateurs?',
	'faq_text_2' => 'Lorsqu\'un client tape sur la carte Tap&Go avec son téléphone portable, il est immédiatement redirigé vers une page Tap&Go. Cette page collecte diverses statistiques de l\'appareil du client, telles que l\'utilisation quotidienne, le système d\'exploitation et le type d\'appareil, parmi d\'autres. Après cette inscription, le client est automatiquement dirigé vers la page d\'avis de votre établissement. Toutes ces données sont mises à disposition, gratuitement, aux acheteurs de nos cartes via notre panneau de contrôle/Dashboard.',

	'faq_title_3' => 'Dans quelles quantités puis-je acheter les cartes Tap&Go?',
	'faq_text_3' => 'Nos cartes Tap&Go, équipées de la technologie NFC pour l\'évaluation, sont vendues en packs de 1, 5, 10 ou 20 unités. Plus la quantité achetée est grande, plus la réduction est avantageuse. Choisissez le pack qui convient le mieux aux besoins et aux objectifs de votre entreprise.',

	'faq_title_4' => 'À quel point les processus de collecte de données sont-ils sécurisés?',
	'faq_text_4' => 'Tap&Go accorde la plus grande importance à la confidentialité et à la sécurité des utilisateurs. Nos processus de collecte de données sont conformes aux derniers protocoles de sécurité, garantissant que les informations capturées restent confidentielles et sont utilisées exclusivement à des fins analytiques au profit des entreprises.',

	'faq_title_5' => 'Les cartes Tap&Go ont-elles une date d\'expiration?',
	'faq_text_5' => 'En ce qui concerne la validité de Tap&Go, vous serez ravi d\'apprendre que pour les cartes actuellement achetées, il n\'y a pas de date d\'expiration. Si vous achetez votre carte Tap&Go maintenant, elle restera valide indéfiniment, offrant des avantages continus pour votre entreprise. Cependant, nous prévenons que c\'est notre politique actuelle, et à l\'avenir, nous pourrions la changer pour de nouveaux achats. Alors, si vous envisagez d\'acheter, profitez de cet avantage tant qu\'il est disponible.',

	'faq_title_6' => 'Accéder à votre panneau et statistiques',
	'faq_text_6' => '<p>Consultez des statistiques détaillées de votre établissement via notre <a href="/dashboard" target="_blank" style="color: blue;">Panneau</a>. Sur cette plateforme, vous pouvez:</p><ul><li>Suivre l\'utilisation quotidienne et hebdomadaire des cartes.</li><li>Analyser les métriques des visiteurs, y compris les systèmes d\'exploitation qu\'ils utilisent.</li><li>Observer les données à travers des graphiques modernes et faciles à comprendre.</li><li>Mettre à jour l\'image d\'arrière-plan associée au lien de redirection de vos cartes, garantissant que l\'image de votre établissement est toujours à jour.</li></ul><p>Après avoir complété votre commande, vous recevrez un email avec un mot de passe temporaire. Une fois que vous accédez au panneau, nous vous recommandons de le changer pour assurer une sécurité maximale.</p>',

	'add_cart_btn' => 'Ajouter au panier',

	'checkout_cart_title' => 'Votre panier',
	'checkout_title_1' => 'Livraison',

	'checkout_label_2' => 'Prénom',
	'checkout_label_3' => 'Nom de famille',
	'checkout_label_4' => 'Email',
	'checkout_label_5' => 'Adresse',
	'checkout_label_6' => 'Établissement',
	'checkout_label_info_6' => 'Assurez-vous que ce champ correspond au nom de votre établissement (par exemple: restaurant, bar)',
	'checkout_label_7' => 'Pays',
	'checkout_label_8' => 'Code postal',

	'checkout_title_2' => 'Paiement',
	'checkout_buy_button' => 'Finaliser le paiement',
	'checkout_final_info' => 'Une fois la commande réussie, vous recevrez un e-mail avec les détails de votre commande, ainsi qu\'un mot de passe temporaire pour accéder aux statistiques de votre établissement sur notre <a href="/dashboard" target="_blank" style="color: blue;">Tableau de bord</a>.',

	'footer_slogan' => 'Tapez, Commentez, Élevez - La puissance à portée de main.',
	'footer_about_us' => 'Tap&Go utilise la technologie NFC pour rationaliser les retours des clients. Nos cartes d\'avis conviviales permettent des avis en temps réel, aidant les entreprises à améliorer leurs services et à renforcer l\'engagement des clients. Embrassez l\'avenir de l\'interaction client avec nous.',

	'footer_link_1' => 'Accueil',
	'footer_link_2' => 'Boutique',
	'footer_link_3' => 'Avantages',
	'footer_link_4' => 'Contactez-nous',
	'footer_link_5' => 'Instagram',

	'pack_1_title' => 'Pack individuel',
	'pack_2_title' => 'Pack de base',
	'pack_3_title' => 'Pack de valeur',
	'pack_4_title' => 'Pack premium',

	'pack_1_qnt' => '1 carte',
	'pack_2_qnt' => '5 cartes',
	'pack_3_qnt' => '10 cartes',
	'pack_4_qnt' => '20 cartes',

	'shipping_badge' => 'Livraison gratuite dans le monde entier',
	'select_offer' => 'Sélectionnez votre offre:',

	'cart_checkout_btn' => 'Payer <i class="fa-solid fa-arrow-right" style="font-weight: bold;"></i>',
	'cart_remove_btn' => 'Retirer',
	'cart_title_your' => 'Votre panier',
	'cart_no_items' => 'Aucun article dans le panier',

	'cart_stripe_text' => 'Vous serez redirigé vers le paiement avec Stripe.',
	'shipping_checkout_info' => 'LIVRAISON GRATUITE',

	'validate_first_name' => 'Veuillez entrer un prénom valide.',
	'validate_last_name' => 'Veuillez entrer un nom de famille valide.',
	'validate_email' => 'Veuillez entrer une adresse e-mail valide.',
	'validate_establishment' => 'Veuillez entrer le nom de votre établissement.',
	'validate_country' => 'Veuillez entrer votre pays.',
	'validate_zip' => 'Veuillez entrer votre code postal.',
	'validate_address' => 'Veuillez entrer votre adresse.',
	'validation_failed' => 'Échec de la validation',
	'validation_failed_btn' => 'Réessayer',
	'black_friday' => 'BLACK FRIDAY - JUSQU\'À 50% DE RÉDUCTION',

	'product_benefit_1' => 'Utilisation Illimitée pour la Collecte d\'Avis',
	'product_benefit_2' => 'Attirer de Nouveaux Clients',
	'product_benefit_3' => 'Parfait pour Toute Entreprise',
	'product_benefit_4' => 'Livraison Rapide dans le Monde Entier',

	

),
'pt' => array(

	'nav_1' => 'Início',
	'nav_2' => 'Produtos',
	'nav_3' => 'Contactos',


	'home_content' => 'Impulsione o seu negócio com maior envolvimento e visibilidade no Google e além...',
	'home_btn' => 'COMPRAR AGORA',
	'header_btn' => 'Comprar Agora',

	'section_1_title' => 'Eleve o Seu Negócio ao Topo do Google com o Tap&Go',
	'section_1_text' => 'Com os nossos cartões Tap&Go, assegure avaliações imediatas no Google, potenciando o seu SEO e posicionando o seu negócio na linha da frente. Uma jogada estratégica para intensificar interações valiosas com os clientes e reforçar a reputação da sua empresa.',
	'section_1_btn' => 'Nossos Produtos',

	'section_2_title' => 'Avaliações instantâneas com um simples movimento NFC',
	'section_2_text' => 'Assista ao vídeo e observe como um rápido passar do nosso cartão NFC permite que os clientes <b>compartilhem instantaneamente</b> suas experiências de 5 estrelas. Desbloqueie um <b>maior envolvimento</b>, melhore a <b>visibilidade no Google</b> e atraia uma onda de clientes fiéis. Simplifique a jornada de feedback, aproveite os benefícios e veja o seu negócio decolar.',
	'section_2_btn' => 'Saiba Mais',

	'section_3_title' => 'Porquê escolher o Tap&Go?',
	'section_3_text' => 'Aumente a sua visibilidade, envolva mais clientes e garanta o seu lugar no topo das classificações do Google.',
	'section_3_benefit_1_title' => 'Ascensão no Google',
	'section_3_benefit_1_text' => 'Eleve a reputação do seu estabelecimento, suba nas classificações do Google e atraia novos clientes com facilidade.',
	'section_3_benefit_2_title' => 'Deslize & Avalie',
	'section_3_benefit_2_text' => 'Qualquer dispositivo inteligente pode se conectar instantaneamente, simplificando o processo de avaliação para os seus clientes.',
	'section_3_benefit_3_title' => 'Presença Profissional',
	'section_3_benefit_3_text' => 'Supere os concorrentes com tecnologia moderna, aprimorando o apelo profissional do seu negócio.',
	'section_3_benefit_4_title' => 'Insights em Tempo Real',
	'section_3_benefit_4_text' => 'Acompanhe as interações, compreenda o seu alcance e otimize as suas estratégias com as nossas análises orientadas por dados.',

	'section_4_title' => 'Nossos Produtos',
	'section_4_btn' => 'Ver Produto',

	'section_5_title' => 'Mais Avaliações, Melhor Negócio',
	'section_5_pack_1_title' => 'Pacote Básico',
	'section_5_pack_1_subtitle' => 'A partir de',
	'section_5_pack_1_price' => '39,95 '.$currency,
	'section_5_pack_1_oldprice' => '59,95 '.$currency,
	'section_5_pack_1_cardnumbers' => '5 Cartões NFC',
	'section_5_pack_1_benefit_1' => 'Integração Flawless de Avaliações no Google',
	'section_5_pack_1_benefit_2' => 'Aumente o Engajamento do Cliente',
	'section_5_pack_1_benefit_3' => 'Configuração e Uso Simples',
	'section_5_pack_1_benefit_4' => 'Garantia de Qualidade',
	'section_5_packs_btn' => 'Obtenha o Seu',

	'section_5_pack_2_title' => 'Pacote Valor',
	'section_5_pack_2_subtitle' => 'A partir de',
	'section_5_pack_2_price' => '59,95 '.$currency,
	'section_5_pack_2_oldprice' => '99,95 '.$currency,
	'section_5_pack_2_cardnumbers' => '10 Cartões NFC',
	'section_5_pack_2_benefit_1' => 'Colecionar Avaliações do Google Sem Esforço',
	'section_5_pack_2_benefit_2' => 'Melhore a Satisfação do Cliente',
	'section_5_pack_2_benefit_3' => 'Conveniente para Múltiplas Localizações',
	'section_5_pack_2_benefit_4' => 'Cartões Confiáveis e Duráveis',

	'section_5_pack_3_title' => 'Pacote Premium',
	'section_5_pack_3_subtitle' => 'A partir de',
	'section_5_pack_3_price' => '99,95 '.$currency,
	'section_5_pack_3_oldprice' => '159,95 '.$currency,
	'section_5_pack_3_cardnumbers' => '20 Cartões NFC',
	'section_5_pack_3_benefit_1' => 'Simplifique o Processo de Avaliação',
	'section_5_pack_3_benefit_2' => 'Melhore a Reputação do Negócio',
	'section_5_pack_3_benefit_3' => 'Ideal para Cadeias e Grandes Estabelecimentos',
	'section_5_pack_3_benefit_4' => 'Valor e Funcionalidade Ótimos',

	'new_section_title' => 'Estatísticas Detalhadas dos seus Clientes',
	'new_section_text' => 'Explore informações detalhadas exclusivas para proprietários de cartões através da nossa plataforma. Desde <b>frequências de utilização</b> dos cartões ao <b>rastreamento das avaliações</b>, os nossos gráficos intuitivos fornecem insights valiosos sobre a interação dos clientes. Tudo disponibilizado <b>gratuitamente</b> via o nosso portal de login amigável, disponibilizado a todos os compradores dos nossos cartões.',

	'faq_title_1' => 'O que são os Cartões Tap&Go?',
	'faq_text_1' => 'Os cartões Tap&Go utilizam a inovadora tecnologia NFC. Ao usá-los, consegue obter avaliações imediatas no Google, uma estratégia eficaz para melhorar o seu SEO e destacar-se não só no Google, mas também noutros motores de pesquisa. Optar pelos cartões Tap&Go é uma decisão inteligente para intensificar interacções significativas com os clientes, reforçar a reputação online da sua empresa e atrair mais clientela.',

	'faq_title_2' => 'Como é que os cartões capturam as estatísticas do uso do utilizador?',
	'faq_text_2' => 'Sempre que um cliente toca no Cartão Tap&Go com o seu telemóvel, é imediatamente redireccionado para uma página Tap&Go. Esta página recolhe diversas estatísticas do dispositivo do cliente, tais como o uso diário, o sistema operativo e o tipo de dispositivo, entre outras. Após este registo, o cliente é automaticamente encaminhado para a página de avaliação do seu estabelecimento. Todos estes dados são disponibilizados, sem qualquer custo, aos compradores dos nossos cartões através do nosso painel de controlo/Dashboard.',

	'faq_title_3' => 'Em que quantidades posso adquirir os Cartões Tap&Go?',
	'faq_text_3' => 'Os nossos Cartões Tap&Go, equipados com tecnologia NFC para avaliação, são comercializados em pacotes de 1, 5, 10 ou 20 unidades. Quanto maior for a quantidade adquirida, mais vantajoso será o desconto. Selecione o pacote que melhor corresponde às necessidades e metas do seu negócio.',

	'faq_title_4' => 'Quão seguros são os processos de recolha de dados?',
	'faq_text_4' => 'A Tap&Go valoriza acima de tudo a privacidade e a segurança dos utilizadores. Os nossos processos de recolha de dados aderem aos protocolos de segurança mais recentes, garantindo que a informação capturada permanece confidencial e é usada exclusivamente para fins analíticos para beneficiar as empresas.',

	'faq_title_5' => 'Os cartões Tap&Go têm prazo de validade?',
	'faq_text_5' => 'Quanto à validade do Tap&Go, ficará agradado em saber que, para os cartões adquiridos actualmente, não existe prazo de expiração. Se adquirir o seu cartão Tap&Go agora, este será válido por tempo indeterminado, proporcionando benefícios contínuos para o seu negócio. No entanto, alertamos que esta é a nossa política actual e, no futuro, poderemos alterá-la para novas aquisições. Assim, se está a considerar a compra, aproveite esta vantagem enquanto está disponível.',

	'faq_title_6' => 'Acedendo ao Seu Painel e Estatísticas',
	'faq_text_6' => '
	<p>
	Consulte estatísticas detalhadas do seu estabelecimento através do nosso 
	<a href="/dashboard" target="_blank" style="color: blue;">Painel</a>. 
	Nesta plataforma, tem a possibilidade de:
	</p>
	<ul>
	<li>Acompanhar a utilização diária e semanal dos cartões.</li>
	<li>Analisar métricas dos visitantes, incluindo os sistemas operativos que usam.</li>
	<li>Observar dados através de gráficos modernos e de fácil interpretação.</li>
	<li>Actualizar a imagem de fundo associada ao link de redireccionamento dos seus cartões, garantindo que a imagem do seu estabelecimento esteja sempre actualizada.</li>
	</ul>
	<p>
	Após finalizar a sua encomenda, irá receber um email com uma palavra-passe temporária. Depois de aceder ao painel, recomendamos que a altere para garantir a máxima segurança.
	</p>
	',
	'add_cart_btn' => 'Adicionar ao Carrinho',

	'checkout_cart_title' => 'Carrinho',
	'checkout_title_1' => 'Entrega',

	'checkout_label_2' => 'Nome',
	'checkout_label_3' => 'Apelido',
	'checkout_label_4' => 'Email',
	'checkout_label_5' => 'Morada',
	'checkout_label_6' => 'Estabelecimento',
	'checkout_label_info_6' => 'Certifique-se de que este campo corresponda ao nome do seu Estabelecimento (Ex: restaurante, bar)',
	'checkout_label_7' => 'País',
	'checkout_label_8' => 'Código Postal',

	'checkout_title_2' => 'Pagamento',
	'checkout_buy_button' => 'Finalizar Pagamento',
	'checkout_final_info' => 'Após a conclusão do pedido com sucesso, você receberá um e-mail com os detalhes do seu pedido, juntamente com uma senha temporária para aceder às estatísticas do seu estabelecimento no nosso <a href="/dashboard" target="_blank" style="color : blue;">Painel</a>.',


	'footer_slogan' => 'Toque, Avalie, Eleve - O Poder na Ponta dos Seus Dedos.',
	'footer_about_us' => 'Tap&Go utiliza a tecnologia NFC para otimizar o feedback dos clientes. Os nossos cartões de avaliação intuitivos permitem avaliações em tempo real, ajudando as empresas a melhorar os seus serviços e a potenciar o envolvimento dos clientes. Abraça o futuro da interação com o cliente connosco.',

	'footer_link_1' => 'Início',
	'footer_link_2' => 'Loja',
	'footer_link_3' => 'Benefícios',
	'footer_link_4' => 'Contacte-nos',
	'footer_link_5' => 'Instagram',

	'pack_1_title' => 'Pacote Único',
	'pack_2_title' => 'Pacote Básico',
	'pack_3_title' => 'Pacote Valor',
	'pack_4_title' => 'Pacote Premium',

	'pack_1_qnt' => '1 Cartão',
	'pack_2_qnt' => '5 Cartões',
	'pack_3_qnt' => '10 Cartões',
	'pack_4_qnt' => '20 Cartões',

	'shipping_badge' => 'Envio Gratuito',

	
	'select_offer' => 'Selecione a oferta:',

	'cart_checkout_btn' => 'Pagamento <i class="fa-solid fa-arrow-right" style="font-weight: bold;"></i>',
	'cart_remove_btn' => 'Remover',

	'cart_title_your' => 'Carrinho',
	'cart_no_items' => 'Sem itens no Carrinho',

	'cart_stripe_text' => 'Será encaminhado para o pagamento com a Stripe.',
	'shipping_checkout_info' => 'ENVIO GRATUITO',

	'validate_first_name' => 'Por favor, insira um nome próprio válido.',
	'validate_last_name' => 'Por favor, insira um apelido válido.',
	'validate_email' => 'Por favor, insira um endereço de e-mail válido.',
	'validate_establishment' => 'Por favor, insira o nome do seu estabelecimento.',
	'validate_country' => 'Por favor, insira o seu país.',
	'validate_zip' => 'Por favor, insira o seu código postal.',
	'validate_address' => 'Por favor, insira a sua morada.',
	'validation_failed' => 'Falha na validação',
	'validation_failed_btn' => 'Tentar Novamente',
	'black_friday' => 'BLACK FRIDAY - ATÉ 50% DESCONTO',

	'product_benefit_1' => 'Uso Ilimitado',
	'product_benefit_2' => 'Atrai Novos Clientes com Reviews',
	'product_benefit_3' => 'Ideal para Qualquer Negócio',
	'product_benefit_4' => 'Envio Rápido',


)
);
?>