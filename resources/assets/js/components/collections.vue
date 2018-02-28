<template>
    <div class="collections-container">
        <div class="collections-nav">
            <div class="collections-nav-item">
                <div class="pets" v-bind:class="[ activeTab == 'pets' ? 'active-tab' : '' ]" v-on:click="changeTab('pets')">Pet Journal</div>
            </div>
            <div class="collections-nav-item">
                <div class="mounts" v-bind:class="[ activeTab == 'mounts' ? 'active-tab' : '' ]" v-on:click="changeTab('mounts')">Mounts</div>
            </div>
        </div>

        <div class="battle-pet-slots-container" v-if="activeTab == 'pets'">
            <div class="battle-pet-slots-header">Battle Pet Slots</div>
            <div class="battle-pet-slots">
                <div class="battle-pet-slot" v-for="petslot in petslots">
                    <div class="battle-pet-slot-info">
                        <div class="battle-pet-slot-image" v-bind:style="{ 'background-image': `url(http://media.blizzard.com/wow/renders/npcs/pet/creature${ petslot.creatureId }.jpg)` }"></div>
                        <div class="battle-pet-slot-name-container">
                            <div class="battle-pet-slot-name" v-bind:style="{ 'color': petslot.quality }">
                                {{ petslot.name }}
                                <div class="battle-pet-slot-name-favorite" v-if="petslot.isFavorite">
                                    <svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64">
                                        <use xlink:href="/img/character/collections/pets/favorite.svg#favorite"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="battle-pet-slot-lvl-container">
                            <div class="battle-pet-slot-lvl">{{ ((petslot.stats.level == 0) ? 'NON-COMBAT PET' : 'level ' + petslot.stats.level) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="collection-container">
            <div class="collection-header">
                {{ ((activeTab == 'mounts') ? 'Mounts' : 'Collection') }}
                <div class="collection-header-collected">{{ collections[0] + ' ' + uppercase(activeTab) }} Collected</div>
            </div>
            <div class="collection">
                <div class="collection-slot" v-for="collection in collections[2]">
                    <div class="collection-slot-info">
                        <div class="collection-slot-image" v-bind:style="{ 'background-image': `url(http://media.blizzard.com/wow/renders/npcs/pet/creature${ collection.creatureId }.jpg)` }"></div>
                        <div class="collection-slot-name-container">
                            <div class="collection-slot-name" v-bind:style="{ 'color': collection.quality }">
                                {{ collection.name }}
                                <div class="collection-slot-name-favorite" v-if="collection.isFavorite && activeTab == 'pets'">
                                    <svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64">
                                        <use xlink:href="/img/character/collections/pets/favorite.svg#favorite"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="collection-slot-lvl-container" v-if="activeTab == 'pets'">
                            <div class="collection-slot-lvl">{{ ((collection.stats.level == 0) ? 'NON-COMBAT PET' : 'level ' + collection.stats.level) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import _ from 'lodash';

    export default {
        name: 'collections',
        props: ['route', 'petslots', 'pets', 'mounts'],
        data() {
            return {
                activeTab: 'pets',
                collections: this.pets
            }
        },
        mounted() {
            if (this.activeTab == 'pets')
            {
                this.collections = this.pets;
            }
            else if (activeTab == 'mounts')
            {
                this.collections = this.mounts;
            }
        },
        methods: {
            changeTab(tab) {
                if (tab == 'pets')
                {
                    this.collections = this.pets;
                }
                else if (tab == 'mounts')
                {
                    this.collections = this.mounts;
                }

                this.activeTab = tab;
            },
            uppercase(tab) {
                return _.startCase(tab);
            }
        }
    }
</script>