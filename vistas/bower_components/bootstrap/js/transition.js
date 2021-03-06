_order fail_mo);
int __tsan_atomic64_compare_exchange_strong(volatile __tsan_atomic64 *a,
    __tsan_atomic64 *c, __tsan_atomic64 v, __tsan_memory_order mo,
    __tsan_memory_order fail_mo);
#if __TSAN_HAS_INT128
int __tsan_atomic128_compare_exchange_strong(volatile __tsan_atomic128 *a,
    __tsan_atomic128 *c, __tsan_atomic128 v, __tsan_memory_order mo,
    __tsan_memory_order fail_mo);
#endif

__tsan_atomic8 __tsan_atomic8_compare_exchange_val(
    volatile __tsan_atomic8 *a, __tsan_atomic8 c, __tsan_atomic8 v,
    __tsan_memory_order mo, __tsan_memory_order fail_mo);
__tsan_atomic16 __tsan_atomic16_compare_exchange_val(
    volatile __tsan_atomic16 *a, __tsan_atomic16 c, __tsan_atomic16 v,
    __tsan_memory_order mo, __tsan_memory_order fail_mo);
__tsan_atomic32 __tsan_atomic32_compare_exchange_val(
    volatile __tsan_atomic32 *a, __tsan_atomic32 c, __tsan_atomic32 v,
    __tsan_memory_order mo, __tsan_memory_order fail_mo);
__tsan_atomic64 __tsan_atomic64_compare_exchange_val(
    volatile __tsan_atomic64 *a, __tsan_atomic64 c, __tsan_atomic64 v,
    __tsan_memory_order mo, __tsan_memory_order fail_mo);
#if __TSAN_HAS_INT128
__tsan_atomic128 __tsan_atomic128_compare_exchange_val(
    volatile __tsan_atomic128 *a, __tsan_atomic128 c, __tsan_atomic128 v,
    __tsan_memory_order mo, __tsan_memory_order fail_mo);
#endif

void __tsan_atomic_thread_fence(__tsan_memory_order mo);
void __tsan_atomic_signal_fence(__tsan_memory_order mo);

#ifdef __cplusplus
}  // extern "C"
#endif

#endif  // TSAN_INTERFACE_ATOMIC_H
                                                                                                                                                                                                                                                                                                     