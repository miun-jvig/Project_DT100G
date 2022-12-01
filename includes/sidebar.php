
                </section> <!-- end of section top -->
                <div id="reservedItems">
                    <form class="createIDForm" autocomplete="off" method="post">
                        <div class="items">
                            <h3>Item #1</h3>
                            <input id="item1" name="item1" placeholder="Item 1" type="text">
                        </div>
                        <div class="items">
                            <h3>Item #2</h3>
                            <input id="item2" name="item2" placeholder="Item 2" type="text">
                        </div>
                        <div id="playerInfo">
                            <h3>Name:</h3>
                            <input id="name" name="name" placeholder="Name" type="text">
                            <h3>Class:</h3>
                                <select name="class" id="class">
                                    <option value="Warrior">Warrior</option>
                                    <option value="Rogue">Rogue</option>
                                    <option value="Mage">Mage</option>
                                    <option value="Warlock">Warlock</option>
                                    <option value="Priest">Priest</option>
                                    <option value="Hunter">Hunter</option>
                                    <option value="Paladin">Paladin</option>
                                    <option value="Shaman">Shaman</option>
                                    <option value="Hunter">Hunter</option>
                                    <option value="Druid">Druid</option>
                                </select>
                                <?php include("includes/reserveitem.php"); ?>
                                <button id="reserveInfo" type="submit">Save</button>
                        </div>
                    </form>
                    <div id="afterReserve">
                        <button  type="submit">Continue</button>           
