<template>
    <TermAndPolicy ref="term" />
    <div class="text-center">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl leading-10">
            Current <span class="text-teal-500">Evidence</span> in <span class="text-violet-500">Nephrology</span> <br> From
            <span class="text-yellow-400">Policy</span> to <span class="text-yellow-400 italic">Practice</span> 2022
        </h1>
        <p class="mt-6 text-sm md:text-lg leading-8 text-gray-600">
            งานประชุมวิชาการสาขาวิชาวักกะวิทยา <br class="md:hidden">คณะแพทยศาสตร์ศิริราชพยาบาล <br>มหาวิทยาลัยมหิดล <br class="md:hidden">ร่วมกับ <br class="md:hidden">สมาคมโรคไตแห่งประเทศไทย <br class="md:hidden">วันที่ 25 - 26 พฤศจิกายน 2565
        </p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a
                :href="loginUrl"
                class="flex items-center rounded-md bg-violet-600 px-3.5 py-1.5 text-base font-semibold leading-7 text-white shadow-sm hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
                <svg
                    viewBox="0 0 512 512"
                    class="w-6 h-6 text-green-500 bg-white rounded-md mr-2"
                ><path
                    fill="currentColor"
                    d="M311 196.8v81.3c0 2.1-1.6 3.7-3.7 3.7h-13c-1.3 0-2.4-.7-3-1.5l-37.3-50.3v48.2c0 2.1-1.6 3.7-3.7 3.7h-13c-2.1 0-3.7-1.6-3.7-3.7V196.9c0-2.1 1.6-3.7 3.7-3.7h12.9c1.1 0 2.4 .6 3 1.6l37.3 50.3V196.9c0-2.1 1.6-3.7 3.7-3.7h13c2.1-.1 3.8 1.6 3.8 3.5zm-93.7-3.7h-13c-2.1 0-3.7 1.6-3.7 3.7v81.3c0 2.1 1.6 3.7 3.7 3.7h13c2.1 0 3.7-1.6 3.7-3.7V196.8c0-1.9-1.6-3.7-3.7-3.7zm-31.4 68.1H150.3V196.8c0-2.1-1.6-3.7-3.7-3.7h-13c-2.1 0-3.7 1.6-3.7 3.7v81.3c0 1 .3 1.8 1 2.5c.7 .6 1.5 1 2.5 1h52.2c2.1 0 3.7-1.6 3.7-3.7v-13c0-1.9-1.6-3.7-3.5-3.7zm193.7-68.1H327.3c-1.9 0-3.7 1.6-3.7 3.7v81.3c0 1.9 1.6 3.7 3.7 3.7h52.2c2.1 0 3.7-1.6 3.7-3.7V265c0-2.1-1.6-3.7-3.7-3.7H344V247.7h35.5c2.1 0 3.7-1.6 3.7-3.7V230.9c0-2.1-1.6-3.7-3.7-3.7H344V213.5h35.5c2.1 0 3.7-1.6 3.7-3.7v-13c-.1-1.9-1.7-3.7-3.7-3.7zM512 93.4V419.4c-.1 51.2-42.1 92.7-93.4 92.6H92.6C41.4 511.9-.1 469.8 0 418.6V92.6C.1 41.4 42.2-.1 93.4 0H419.4c51.2 .1 92.7 42.1 92.6 93.4zM441.6 233.5c0-83.4-83.7-151.3-186.4-151.3s-186.4 67.9-186.4 151.3c0 74.7 66.3 137.4 155.9 149.3c21.8 4.7 19.3 12.7 14.4 42.1c-.8 4.7-3.8 18.4 16.1 10.1s107.3-63.2 146.5-108.2c27-29.7 39.9-59.8 39.9-93.1z"
                /></svg>
                ลงชื่อใช้งาน
            </a>
        </div>
        <small
            class="mt-10 text-xs md:text-sm font-medium text-red-600"
            v-show="$page.props.errors.status"
        >
            {{ $page.props.errors.status }}
        </small>
        <button
            @click="term.toggle"
            class="mt-10 text-xs md:text-sm font-medium text-violet-600"
        >
            อ่านข้อตกลงการใช้งานและนโยบายความเป็นส่วนตัว
        </button>
    </div>
</template>

<script setup>

import TermAndPolicy from '../Components/TermAndPolicy.vue';
import {ref} from 'vue';

defineProps({
    loginUrl: { type: String, required: true },
});

const term = ref(null);
</script>

<script>
import PageLayout from '../Components/Layouts/PageLayout.vue';
export default {
    layout: PageLayout,
};
</script>
