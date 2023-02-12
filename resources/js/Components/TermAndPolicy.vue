<template>
    <TransitionRoot
        as="template"
        :show="open"
    >
        <Dialog
            as="div"
            class="relative z-10"
            @close="open = false"
        >
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                            <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                                <button
                                    type="button"
                                    class="rounded-md bg-white text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2"
                                    @click="open = false"
                                >
                                    <span class="sr-only">Close</span>
                                    <XMarkIcon
                                        class="h-6 w-6"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <LockClosedIcon
                                        class="h-6 w-6 text-green-600"
                                        aria-hidden="true"
                                    />
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <DialogTitle
                                        as="h3"
                                        class="text-lg font-medium leading-6 text-slate-900"
                                    >
                                        ข้อตกลงการใช้งานและนโยบายความเป็นส่วนตัว
                                    </DialogTitle>
                                    <div class="mt-2">
                                        <h4>
                                            ข้อตกลงการใช้งาน
                                        </h4>
                                        <p class="text-sm text-slate-500">
                                            ระบบจัดเก็บสถิติการใช้งานของท่าน กรุณาไม่นำบัญชีใช้งานให้ผู้อื่นใช้ ระบบอาจปิดใช้งานได้โดยไม่ต้องแจ้งให้ท่านทราบล่วงหน้า
                                        </p>
                                        <h4 class="mt-4">
                                            นโยบายความเป็นส่วนตัว
                                        </h4>
                                        <p class="text-sm text-slate-500">
                                            ระบบเก็บข้อมูล LINE โปรไฟล์ของท่านเพื่ออำนวยความสะดวกในการลงชื่อเข้าใช้งาน โดยจะเชื่อมกับข้อมูลหมายเลขโทรศัพท์และอีเมล์ที่ท่านให้ไว้ตอนลงทะเบียนเข้างานฯ เพื่อยืนยันสิทธิ์เท่านั้นโดยจะไม่เชื่อมเข้ากับข้อมูลส่วนบุคคลอื่นๆ ของท่านที่สาขาฯ อาจมีเก็บไว้จากกิจกรรมอื่น (เช่น ชื่อ นามสกุล เป็นต้น) ทั้งนี้ระบบไม่สามารถส่งข้อความหรือติดต่อท่านผ่านทาง LINE ได้ โดยการเก็บรักษาข้อมูลส่วนบุคคลที่ได้กล่าวมานี้ทำด้วยระดับความมั่นคงตามมาตรฐานอุตสาหกรรม  และจะไม่มีการนำข้อมูลนี้ไปใช้เพื่อการอื่นหรือเปิดเผยต่อบุคคลอื่นทั้งสิ้น เว้นแต่เป็นกรณีบังคับตามกฏหมาย
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <button
                                    type="button"
                                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                                    @click="open = false"
                                >
                                    เข้าใจแล้ว
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { LockClosedIcon, XMarkIcon } from '@heroicons/vue/24/outline';

const open = ref(false);

function toggle() {
    open.value = !open.value;
}
defineExpose({toggle});
</script>
