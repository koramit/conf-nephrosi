<template>
    <Head :title="$page.props.flash.title" />
    <div>
        <TransitionRoot
            as="template"
            :show="sidebarOpen"
        >
            <Dialog
                as="div"
                class="relative z-40 md:hidden"
                @close="sidebarOpen = false"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-violet-600 bg-opacity-75" />
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild
                        as="template"
                        enter="transition ease-in-out duration-300 transform"
                        enter-from="-translate-x-full"
                        enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform"
                        leave-from="translate-x-0"
                        leave-to="-translate-x-full"
                    >
                        <DialogPanel class="relative flex w-full max-w-xs flex-1 flex-col bg-white">
                            <TransitionChild
                                as="template"
                                enter="ease-in-out duration-300"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="ease-in-out duration-300"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <div class="absolute top-0 right-0 -mr-12 pt-2">
                                    <button
                                        type="button"
                                        class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                        @click="sidebarOpen = false"
                                    >
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon
                                            class="h-6 w-6 text-white"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>
                            </TransitionChild>
                            <div class="h-0 flex-1 overflow-y-auto pt-5 pb-4">
                                <a
                                    href="https://www.simedicine.org/branch_details/48287dd7-3d73-4a00-856f-20f5653bea96"
                                    class="flex flex-shrink-0 items-center px-4"
                                >
                                    <img
                                        class="h-8 w-auto"
                                        src="../../images/ihtm.png"
                                        alt="NephroSI logo"
                                    >
                                </a>
                                <nav class="mt-5 px-2">
                                    <div
                                        v-for="season in seasons"
                                        :key="season.season"
                                    >
                                        <div class="space-y-1">
                                            <button
                                                class="w-full block text-left font-bold py-2"
                                                :class="{
                                                    'text-violet-600': !showGallery,
                                                    'text-teal-600': showGallery,
                                                }"
                                                @click="openGallery(season.season)"
                                            >
                                                Gallery
                                            </button>
                                            <div
                                                v-for="day in season.days"
                                                :key="day.day"
                                            >
                                                <button
                                                    class="w-full flex items-center space-x-1 justify-start text-violet-600 font-bold py-2"
                                                    @click="day.show = !day.show"
                                                >
                                                    <span>Day #{{ day.day }}</span>
                                                    <ChevronRightIcon
                                                        class="h-5 w-5 text-violet-600 transition duration-200 ease-in-out transform"
                                                        :class="{'rotate-90': day.show}"
                                                    />
                                                </button>
                                                <Transition name="slide-fade">
                                                    <div v-if="day.show">
                                                        <div
                                                            v-for="(section, key) in day.sections"
                                                            :key="key"
                                                            class="py-4 pl-4"
                                                        >
                                                            <p
                                                                v-if="section.title"
                                                                class="flex space-x-1"
                                                            >
                                                                <span class="-mt-1 mr-2">๏</span>
                                                                <span>{{ section.title }}</span>
                                                            </p>
                                                            <div class="mt-4 space-y-2">
                                                                <button
                                                                    v-for="(episode, ep) in section.episodes"
                                                                    :key="ep"
                                                                    class="w-full text-left rounded-md bg-slate-50 p-2 bg-violet-500/90 text-white"
                                                                    @click="selectEpisode(episode)"
                                                                >
                                                                    {{ episode.title }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </Transition>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                            <div class="flex flex-shrink-0 border-t border-slate-200 p-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center">
                                        <div>
                                            <img
                                                class="inline-block h-10 w-10 rounded-full"
                                                :src="$page.props.user.avatar"
                                                alt=""
                                            >
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-base font-medium text-slate-700 group-hover:text-slate-900">
                                                {{ $page.props.user.name }}
                                            </p>
                                            <button
                                                class="text-sm font-medium text-violet-500 group-hover:text-slate-700"
                                                @click="router.delete(routes.logout)"
                                            >
                                                ลงชื่อออก
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                    <div class="w-14 flex-shrink-0">
                        <!-- Force sidebar to shrink to fit close icon -->
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:fixed md:inset-y-0 md:flex md:w-80 md:flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex min-h-0 flex-1 flex-col border-r border-slate-200 bg-gradient-to-r from-teal-400 to-violet-500">
                <div class="flex flex-1 flex-col overflow-y-auto pt-5 pb-4">
                    <a
                        href="https://www.simedicine.org/branch_details/48287dd7-3d73-4a00-856f-20f5653bea96"
                        class="flex flex-shrink-0 items-center px-4"
                    >
                        <img
                            class="h-8 w-auto"
                            src="../../images/ihtm.png"
                            alt="NephroSI logo"
                        >
                    </a>
                    <nav class="mt-5 flex-1 space-y-1 bg-gradient-to-r from-teal-400 to-violet-500 px-2">
                        <div
                            v-for="season in seasons"
                            :key="season.season"
                        >
                            <div class="space-y-1">
                                <button
                                    class="w-full block font-bold rounded-lg py-4"
                                    :class="{
                                        'text-white bg-teal-400': showGallery,
                                        'text-violet-600 bg-white/70': !showGallery,
                                    }"
                                    @click="openGallery(season.season)"
                                >
                                    Gallery
                                </button>
                                <div
                                    v-for="day in season.days"
                                    :key="day.day"
                                >
                                    <button
                                        class="w-full flex items-center space-x-1 justify-center text-violet-600 font-bold bg-white/70 rounded-lg py-4"
                                        @click="day.show = !day.show"
                                    >
                                        <span>Day #{{ day.day }}</span>
                                        <ChevronRightIcon
                                            class="h-5 w-5 text-violet-600 transition duration-200 ease-in-out transform"
                                            :class="{'rotate-90': day.show}"
                                        />
                                    </button>
                                    <Transition name="slide-fade">
                                        <div v-if="day.show">
                                            <div
                                                v-for="(section, key) in day.sections"
                                                :key="key"
                                                class="py-4 pl-4"
                                            >
                                                <p
                                                    v-if="section.title"
                                                    class="flex space-x-1 text-white"
                                                >
                                                    <span class="-mt-1">๏</span> <span>{{ section.title }}</span>
                                                </p>
                                                <div class="mt-4 space-y-2">
                                                    <button
                                                        v-for="(episode, ep) in section.episodes"
                                                        :key="ep"
                                                        class="w-full text-left rounded-md bg-slate-50 p-2 transition transition-colors duration-200 ease-in-out hover:bg-violet-500 hover:text-white"
                                                        :class="{'bg-violet-500 text-white': episode.title === selectedEpisode.title}"
                                                        @click="selectEpisode(episode)"
                                                    >
                                                        {{ episode.title }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </Transition>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="flex flex-shrink-0 border-t border-slate-200 p-4">
                    <div class="w-full flex-shrink-0">
                        <div class="flex items-center">
                            <div>
                                <img
                                    class="inline-block h-9 w-9 rounded-full"
                                    :src="$page.props.user.avatar"
                                    alt=""
                                >
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-slate-700 group-hover:text-slate-900">
                                    {{ $page.props.user.name }}
                                </p>
                                <button
                                    class="text-sm font-medium text-violet-500 group-hover:text-slate-700"
                                    @click="router.delete(routes.logout)"
                                >
                                    ลงชื่อออก
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-1 flex-col md:pl-80">
            <div class="sticky top-0 z-10 bg-white pl-1 pt-1 sm:pl-3 sm:pt-3 md:hidden">
                <button
                    type="button"
                    class="-ml-0.5 -mt-0.5 inline-flex h-12 w-12 items-center justify-center rounded-md text-slate-500 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-violet-500"
                    @click="sidebarOpen = true"
                >
                    <span class="sr-only">Open sidebar</span>
                    <Bars3Icon
                        class="h-6 w-6"
                        aria-hidden="true"
                    />
                </button>
            </div>
            <main class="flex-1">
                <div class="py-6">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
                        <h1
                            id="episode-title"
                            class="text-2xl font-semibold text-violet-900"
                        >
                            {{ selectedEpisode.title }}
                        </h1>
                    </div>
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
                        <!-- Replace with your content -->
                        <div class="py-4">
                            <div
                                v-show="showGallery"
                            >
                                <div
                                    v-for="(season, key) in images"
                                    :key="key"
                                    class="space-y-4 md:space-y-8"
                                    v-show="true"
                                >
                                    <div
                                        v-for="(set,setKey) in season.sets"
                                        :key="setKey"
                                    >
                                        <button
                                            class="flex items-center text-2xl font-semibold text-violet-700 underline underline-offset-4"
                                            @click="set.show = !set.show"
                                        >
                                            {{ set.label }}
                                            <ChevronRightIcon
                                                class="ml-2 h-5 w-5 text-violet-600 transition duration-200 ease-in-out transform"
                                                :class="{'rotate-90': set.show}"
                                            />
                                        </button>
                                        <Transition name="slide-fade">
                                            <lightgallery
                                                :settings="{ speed: 500, plugins: galleryPlugins }"
                                                class="mt-2 md:mt-4 grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 xl:gap-10 rounded-lg p-2 border-4 border-dashed border-violet-200"
                                                v-if="set.show"
                                            >
                                                <a
                                                    v-for="(image) in set.images"
                                                    :key="image"
                                                    :href="image"
                                                >
                                                    <img
                                                        class="object-center object-cover w-full aspect-square border-8 border-white rounded-lg shadow-lg transform hover:border-0 hover:rounded-none hover:scale-110 duration-300 ease-in-out"
                                                        :alt="image"
                                                        :src="image"
                                                        loading="lazy"
                                                    >
                                                </a>
                                            </lightgallery>
                                        </Transition>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="rounded-lg p-2 border-4 border-dashed border-violet-200"
                                v-if="showPlayer"
                            >
                                <video
                                    id="player"
                                    playsinline
                                    controls
                                    poster="../../images/poster.png"
                                    style="--plyr-color-main: rgb(124, 58, 237);"
                                >
                                    <source
                                        :src="selectedEpisode.source"
                                        type="video/mp4"
                                    >
                                </video>
                            </div>
                            <div class="mt-2 text-sm md:text-base md:mt-6 flex flex-col md:flex-row items-center justify-between">
                                <em>{{ selectedEpisode.speakers }}</em>
                                <a
                                    v-show="selectedEpisode.slide"
                                    :href="selectedEpisode.slide"
                                    target="_blank"
                                    class="text-violet-500"
                                >เอกสารประกอบการบรรยาย</a>
                            </div>
                            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
                                <svg
                                    class="relative left-[calc(50%+3rem)] h-[21.1875rem] max-w-none -translate-x-1/2 sm:left-[calc(50%+36rem)] sm:h-[42.375rem]"
                                    viewBox="0 0 1155 678"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill="url(#ecb5b0c9-546c-4772-8c71-4d3f06d544bc)"
                                        fill-opacity=".3"
                                        d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z"
                                    />
                                    <defs>
                                        <linearGradient
                                            id="ecb5b0c9-546c-4772-8c71-4d3f06d544bc"
                                            x1="1155.49"
                                            x2="-78.208"
                                            y1=".177"
                                            y2="474.645"
                                            gradientUnits="userSpaceOnUse"
                                        >
                                            <stop stop-color="#9089FC" />
                                            <stop
                                                offset="1"
                                                stop-color="#FF80B5"
                                            />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <!-- /End replace -->
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import Plyr from 'plyr';
import 'plyr/dist/plyr.css';
import {Head, router} from '@inertiajs/vue3';
import {nextTick, reactive, ref} from 'vue';
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { Bars3Icon, XMarkIcon, ChevronRightIcon,} from '@heroicons/vue/24/outline';
import Lightgallery from 'lightgallery/vue';
import lgThumbnail from 'lightgallery/plugins/thumbnail';
import lgZoom from 'lightgallery/plugins/zoom';
import 'lightgallery/css/lightgallery.css';
import 'lightgallery/css/lg-thumbnail.css';
import 'lightgallery/css/lg-zoom.css';

const props = defineProps({
    seasonsData: { type: Array, required: true },
    imagesData: { type: Array, required: true },
    routes: { type: Object, required: true },
});

const seasons = ref([...props.seasonsData]);
const images = reactive({...props.imagesData});
const galleryPlugins = [lgThumbnail, lgZoom];

let plyr;
const showPlayer = ref(false);
const sidebarOpen = ref(false);
const showGallery = ref(true);

const selectedEpisode = ref({
    title: '',
    source: '',
    speakers: '',
    slide: null,
});

function openGallery(season) {
    showPlayer.value = false;
    showGallery.value = true;
    sidebarOpen.value = false;
    selectedEpisode.value = {
        title: '',
        source: '',
        speakers: '',
        slide: null,
    };
}

function selectEpisode(episode) {
    showPlayer.value = false;
    showGallery.value = false;
    if (plyr !== undefined) {
        plyr.destroy();
    }
    selectedEpisode.value = {...episode};
    showPlayer.value = true;

    nextTick(() => {
        plyr = new Plyr('#player');
        plyr.source = {
            type: 'video',
            sources: [
                {
                    src: selectedEpisode.value.source,
                    type: 'video/mp4',
                },
            ],
        };
        plyr.play();
        sidebarOpen.value = false;
        setTimeout(() => document.getElementById('episode-title').scrollIntoView({behavior: 'smooth'}), 400);

        window.axios
            .post(props.routes.episodeViewStore, {
                episode_id: selectedEpisode.value.id
            }).catch(error => console.log(error));
    });
}
</script>
