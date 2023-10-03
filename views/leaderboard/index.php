
<div class = "container stats">
    <section class="breadcrumbs" <?php if (!Application::$isDark) { ?>style = "border-bottom: 1px solid #ddd; margin-bottom: 10px;"<?php } ?>>
        <?=Controller::buildCrumbs();?>
    </section>
    <section class="general-stats roster">
        <table class="stats-table">
            <tr class="first">   
                        <th COLSPAN=<?= count($this->aSections)?>>Leaders</th>
            </tr>
            <tr class="second">
                <?php
                    foreach ($this->aSections as $sSection) {
                        echo '<th>'.$sSection.'</th>';
                    }
                ?>
            </tr>
            <?php
                if (!empty($this->aLeaders)) {
                    ?>
                        <?php
                            foreach ($this->aLeaders as $oLeader) {
                                echo '
                                    <tr>
                                        <td>'.$oLeader->name.'</td>
                                        <td>'.$oLeader->playerid.'</td>
                                        <td>'.$oLeader->TotalMoney.'</td>
                                        <td>'.$oLeader->prestigeLevel.'</td>
                                    </tr>
                                ';
                            }
                        ?>
                    <?php
                }
            ?>
    </section>
</div>
