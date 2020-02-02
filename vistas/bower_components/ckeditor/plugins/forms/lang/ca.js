a specific base address.</returns>
      <param name="serviceType">Specifies the type of service to host. </param>
      <param name="baseAddresses">The <see cref="T:System.Array" /> of type <see cref="T:System.Uri" /> that contains the base addresses for the service hosted.</param>
    </member>
    <member name="T:System.ServiceModel.Activation.ServiceRoute">
      <summary>Enables the creation of service routes over HTTP for WCF Services with support for extension-less base addresses. </summary>
    </member>
    <member name="M:System.ServiceModel.Activation.ServiceRoute.#ctor(System.String,System.ServiceModel.Activation.ServiceHostFactoryBase,System.Type)">
      <summary>Initializes a new instance of the <see cref="T:System.ServiceModel.Activation.ServiceRoute" /> class with the specified route prefix, service host factory, and service type.</summary>
      <param name="routePrefix">The route prefix.</param>
      <param name="serviceHostFactory">An instance of the <see cref="T:System.ServiceModel.Activation.ServiceHostFactory" /> class. </param>
      <param name="serviceType">The service type.</param>
    </member>
    <member name="T:System.ServiceModel.Activities.Activation.WorkflowServiceHostFactory">
      <summary>A factory that provides instances of <