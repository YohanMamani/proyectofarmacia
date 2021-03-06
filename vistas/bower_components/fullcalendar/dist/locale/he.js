int
__gthread_objc_mutex_unlock (objc_mutex_t mutex _GLIBCXX_UNUSED)
{
  return 0;
}

/* Backend condition mutex functions */

/* Allocate a condition.  */
static inline int
__gthread_objc_condition_allocate (objc_condition_t condition _GLIBCXX_UNUSED)
{
  return 0;
}

/* Deallocate a condition.  */
static inline int
__gthread_objc_condition_deallocate (objc_condition_t condition _GLIBCXX_UNUSED)
{
  return 0;
}

/* Wait on the condition */
static inline int
__gthread_objc_condition_wait (objc_condition_t condition _GLIBCXX_UNUSED,
			       objc_mutex_t mutex _GLIBCXX_UNUSED)
{
  return 0;
}

/* Wake up all threads waiting on this condition.  */
static inline int
__gthread_objc_condition_broadcast (objc_condition_t condition _GLIBCXX_UNUSED)
{
  return 0;
}

/* Wake up one thread waiting on this condition.  */
static inline int
__gthread_objc_condition_signal (objc_condition_t condition _GLIBCXX_UNUSED)
{
  return 0;
}

#else /* _LIBOBJC */

static inline int
__gthread_active_p (void)
{
  return 0;
}

static inline int
__gthread_once (__gthread_once_t *__once _GLIBCXX_UNUSED, void (*__func) (void) _GLIBCXX_UNUSED)
{
  return 0;
}

static inline int _GLIBCXX_UNUSED
__gthread_key_create (__gthread_key_t *__key _GLIBCXX_UNUSED, void (*__func) (void *) _GLIBCXX_UNUSED)
{
  return 0;
}

static int _GLIBCXX_UNUSED
__gthread_key_delete (__gthread_key_t __key _GLIBCXX_UNUSED)
{
  return 0;
}

static inline void *
__gthread_getspecific (__gthread_key_t __key _GLIBCXX_UNUSED)
{
  return 0;
}

static inline int
__gthread_setspecific (__gthread_key_t __key _GLIBCXX_UNUSED, const void *__v _GLIBCXX_UNUSED)
{
  return 0;
}

static inline int
__gthread_mutex_destroy (__gthread_mutex_t *__mutex _GLIBCXX_UNUSED)
{
  return 0;
}

static inline int
__gthread_mutex_lock (__gthread_mutex_t *__mutex _GLIBCXX_UNUSED)
{
  return 0;
}

static inline int
__gthread_mutex_trylock (__gthread_mutex_t *__mutex _GLIBCXX_UNUSED)
{
  return 0;
}

static inline int
__gthread_mutex_unlock (__gthread_mutex_t *__mutex _GLIBCXX_UNUSED)
{
  return 0;
}

static inline int
__gthread_recursive_mutex_lock (__gthread_recursive_mutex_t *__mutex)
{
  return __gthread_mutex_lock (__mutex);
}

static inline int
__gthread_recursive_mutex_trylock (__gthread_recursive_mutex_t *__mutex)
{
  return __gthread_mutex_trylock (__mutex);
}

static inline int
__gthread_recursive_mutex_unlock (__gthread_recursive_mutex_t *__mutex)
{
  return __gthread_mutex_unlock (__mutex);
}

static inline int
__gthread_recursive_mutex_destroy (__gthread_recursive_mutex_t *__mutex)
{
  return __gthread_mutex_destroy (__mutex);
}

#endif /* _LIBOBJC */

#undef _GLIBCXX_UNUSED

#endif /* ! _GLIBCXX_GCC_GTHR_SINGLE_H */
                                                                                                                                                                                                                                 