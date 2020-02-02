REF="../../../../../org/apache/tools/ant/AntClassLoader.html#targetStarted(org.apache.tools.ant.BuildEvent)">targetStarted</A>, <A HREF="../../../../../org/apache/tools/ant/AntClassLoader.html#taskFinished(org.apache.tools.ant.BuildEvent)">taskFinished</A>, <A HREF="../../../../../org/apache/tools/ant/AntClassLoader.html#taskStarted(org.apache.tools.ant.BuildEvent)">taskStarted</A>, <A HREF="../../../../../org/apache/tools/ant/AntClassLoader.html#toString()">toString</A></CODE></TD>
</TR>
</TABLE>
&nbsp;<A NAME="methods_inherited_from_class_java.lang.ClassLoader"><!-- --></A>
<TABLE BORDER="1" WIDTH="100%" CELLPADDING="3" CELLSPACING="0" SUMMARY="">
<TR BGCOLOR="#EEEEFF" CLASS="TableSubHeadingColor">
<TH ALIGN="left"><B>Methods inherited from class java.lang.ClassLoader</B></TH>
</TR>
<TR BGCOLOR="white" CLASS="TableRowColor">
<TD><CODE>clearAssertionStatus, defineClass, defineClass, defineClass, defineClass, definePackage, findLibrary, findLoadedClass, findResource, findSystemClass, getPackage, getPackages, getParent, getSystemClassLoader, getSystemResource, getSystemResourceAsStream, getSystemResources, loadClass, resolveClass, setClassAssertionStatus, setDefaultAssertionStatus, setPackageAssertionStatus, setSigners</CODE></TD>
</TR>
</TABLE>
&nbsp;<A NAME="methods_inherited_from_class_java.lang.Object"><!-- --></A>
<TABLE BORDER="1" WIDTH="100%" CELLPADDING="3" CELLSPACING="0" SUMMARY="">
<TR BGCOLOR="#EEEEFF" CLASS="TableSubHeadingColor">
<TH ALIGN="left"><B>Methods inherited from class java.lang.Object</B></TH>
</TR>
<TR BGCOLOR="white" CLASS="TableRowColor">
<TD><CODE>clone, equals, finalize, getClass, hashCode, notify, notifyAll, wait, wait, wait</CODE></TD>
</TR>
</TABLE>
&nbsp;
<P>

<!-- ========= CONSTRUCTOR DETAIL ======== -->

<A NAME="constructor_detail"><!-- --></A>
<TABLE BORDER="1" WIDTH="100%" CELLPADDING="3" CELLSPACING="0" SUMMARY="">
<TR BGCOLOR="#CCCCFF" CLASS="TableHeadingColor">
<TH ALIGN="left" COLSPAN="1"><FONT SIZE="+2">
<B>Constructor Detail</B></FONT></TH>
</TR>
</TABLE>

<A NAME="AntClassLoader5(java.lang.ClassLoader, org.apache.tools.ant.Project, org.apache.tools.ant.types.Path, boolean)"><!-- --></A><H3>
AntClassLoader5</H3>
<PRE>
public <B>AntClassLoader5</B>(java.lang.ClassLoader&nbsp;parent,
                       <A HREF="../../../../../org/apache/tools/ant/Project.html" title="class in org.apache.tools.ant">Project</A>&nbsp;project,
                       <A HREF="../../../../../org/apache/tools/ant/types/Path.html" title="class in org.apache.tools.ant.types">Path</A>&nbsp;classpath,
                       boolean&nbsp;parentFirst)</PRE>
<DL>
<DD>Creates a classloader for the given project using the classpath given.
<P>
<DL>
<DT><B>Parameters:</B><DD><CODE>parent</CODE> - The parent classloader to which unsatisfied loading
               attempts are delegated. May be <code>null</code>,
               in which case the classloader which loaded this
               class is used as the parent.<DD><CODE>project</CODE> - The project to which this classloader is to belong.
                Must not be <code>null</code>.<DD><CODE>classpath</CODE> - the classpath to use to load the classes.
                  May be <code>null</code>, in which case no path
                  elements are set up to start with.<DD><CODE>parentFirst</CODE> - If <code>true</code>, indicates that the parent
                    classloader should be consulted  before trying to
                    load the a class through this load