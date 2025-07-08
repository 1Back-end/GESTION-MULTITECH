 <p class="text-justify"><?= nl2br(htmlspecialchars($row['description'])); ?></p>
                
                <?php
                    $numero_whatsapp = "237678536884";
                    $infos = "Bonjour, je suis intéressé par votre logement publié sur le site.\n\n";
                    $infos .= "📝 Type de logement : " . $row['type_logement'] . "\n";
                    $infos .= "📍 Région : " . $row['region_nom'] . "\n";
                    $infos .= "🏙️ Ville : " . $row['ville_nom'] . "\n";
                    $infos .= "📌 Quartier : " . $row['quartier_nom'] . "\n";
                    $infos .= "💰 Prix : " . number_format($row['prix'], 0, ',', ' ') . " FCFA\n";
                    $infos .= "🚗 Distance route : " . $row['distance'] . "\n";
                    $infos .= "🚶 Distance destination : " . $row['destination'] . " Km\n";
                
                    $message = urlencode($infos);
                ?>
                <div class="text-center mt-3">
                    <a href="https://wa.me/<?php echo $numero_whatsapp; ?>?text=<?php echo $message; ?>"
                       target="_blank"
                       class="btn btn-success btn-lg px-4 shadow-none">
                       <i class="bi bi-whatsapp"></i> Contacter via WhatsApp
                    </a>
                </div>
            </div>
        </div>