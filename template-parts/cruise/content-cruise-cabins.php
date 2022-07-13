<?php
$cruise_data = $args['cruise_data'];
$cabins = $cruise_data['CabinDTOs'];

$curentYear = date("Y");

?>
<section class="cruise-cabins" id="cabins">
    <div class="cruise-cabins__content">

        <div class="title-group">
            <div class="title-group__title">
                Cabins
            </div>
            <div class="title-group__sub">
                There are X cabins types available
            </div>
        </div>
        <div class="cruise-cabins__content__slider" id="cabins-slider">
            <?php
            $cabinCount = 0;
            foreach ($cabins as $cabin) :
            ?>

                <a class="cabins-card">
                    <div class="cabins-card__image">
                        <img src=<?php echo afloat_dfcloud_image($cabin['ImageDTOs'][0]['ImageUrl']); ?>>
                    </div>
                    <div class="cabins-card__content">
                        <div class="cabins-card__content__title-section">
                            <div class="cabins-card__content__title-section__sub">
                                Label
                            </div>
                            <div class="cabins-card__content__title-section__title">
                                <?php echo $cabin['Name']; ?>
                            </div>
                        </div>

                    </div>
                </a>



            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php
function checkDeparturesInYear($year, $departureList)
{
    $match = false;
    foreach ($departureList as $d) {
        if (str_contains($d['DepartureDate'], strval($year))) {
            $match = true;
        }
    }
    return $match;
}

?>